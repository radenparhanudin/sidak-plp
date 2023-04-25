<?php

namespace Modules\Administrator\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\MasterData\Entities\Opd;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $opds = Opd::orderBy('nama')->get();
        $roles = Role::whereNotIn('name', ['administrator'])->orderBy('description')->get();
        return view('administrator::user.index', compact('opds', 'roles'));
    }

    public function download(Request $request)
    {
        if($request->ajax()){
            $request->validate(['nip' => 'required'],[],['nip' => 'NIP ASN']);
            $nips = explode("\r\n", $request->nip);
            foreach ($nips as $nip) {
                $pns = $this->getRequestSiasnInstansi("/profilasn/api/pns?nip_lama=&nip_baru=$nip");
                if(isset($pns['Value'])){
                    $pns_id = $pns['Value'][0]['id'];
                    $orang = $this->getRequestSiasnInstansi("/profilasn/api/orang?id=$pns_id");
                    $orang = $pns['Value'][0];
                    User::updateOrCreate([
                        'id'       => $orang['id'],
                    ],[
                        'id'       => $orang['id'],
                        'name'     => $orang['nama'],
                        'username' => $orang['nip_baru'],
                        'email' => $orang['nip_baru'] .'@mail.com',
                    ]);
                }
            }

            return $this->sendReponse(false, Response::HTTP_OK, "Download data berhasil");
        }
    }

    public function edit(Request $request, $id)
    {
        if($request->ajax()){
            $data = User::find($id);
            $data['action'] = route('user.update', $id);
            $data['role_name'] = $data->getRoleNames()[0] ?? "";
            return $this->sendReponse(false, Response::HTTP_OK, null, [$data]);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $request->validate(['opd_id' => 'required', 'role_name' => 'required'],[],['opd_id' => 'OPD', 'role_name' => 'Role']);
            $data         = User::find($id);
            $data->opd_id = $request->opd_id;
            $data->save();
            $data->fresh();
            $data->syncRoles([$request->role_name]);
            return $this->sendReponse(false, Response::HTTP_OK, "Update data berhasil");
        }
    }

    public function delete(Request $request, $id)
    {
        User::destroy($id);
        return $this->sendReponse(false, Response::HTTP_OK, "Hapus data berhasil");
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $data = User::query()->with('opd')->select('users.*');
            return DataTables::eloquent($data)
            ->addColumn('opd', function ($data){
                return $data->opd->nama ?? "";
            })
            ->addColumn('roles', function ($data) {
                return $data->roles->map(function($role) {
                    return $role->description;
                })->implode(', ');
            })
            ->addColumn('action', function ($data) {
                if($data->username != "administrator"){
                    return view('components.datatable-action', [
                        'actions' => [
                            'edit' => [
                                'href' => route('user.edit', $data->id),
                                'show' => 1
                            ],
                            'delete' => [
                                'href' => route('user.delete', $data->id),
                                'show' => 1
                            ]
                        ]
                    ]);
                }
            })->toJson();
        }
    }
}
