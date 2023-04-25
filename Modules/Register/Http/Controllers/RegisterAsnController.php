<?php

namespace Modules\Register\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\MasterData\Entities\Asn;
use Yajra\DataTables\Facades\DataTables;

class RegisterAsnController extends Controller
{
    public function index()
    {
        return view('register::asn.index');
    }

    public function download(Request $request)
    {
        if($request->ajax()){
            $request->validate(['nip' => 'required'],[],['nip' => 'NIP ASN']);
            $nips = explode("\r\n", $request->nip);
            $opd_id = Auth::user()->opd_id;
            foreach ($nips as $nip) {
                $pns = $this->getRequestSiasnInstansi("/profilasn/api/pns?nip_lama=&nip_baru=$nip");
                if(isset($pns['Value'])){
                    $pns_id = $pns['Value'][0]['id'];
                    $orang = $this->getRequestSiasnInstansi("/profilasn/api/orang?id=$pns_id");
                    $orang = $pns['Value'][0];
                    Asn::updateOrCreate([
                        'id'       => $orang['id'],
                    ],[
                        'id'       => $orang['id'],
                        'nip_baru' => $orang['nip_baru'],
                        'nama'     => $orang['nama'],
                        'opd_id'   => $opd_id,
                    ]);
                }
            }

            return $this->sendReponse(false, Response::HTTP_OK, "Download data berhasil");
        }
    }

    public function delete(Request $request, $id)
    {
        if($request->ajax()){
            Asn::destroy($id);
            return $this->sendReponse(false, Response::HTTP_OK, "Hapus data berhasil");
        }
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $data = Asn::query()->with('opd')->whereOpdId(Auth::user()->opd_id)->select('asns.*');
            return DataTables::eloquent($data)
            ->addColumn('opd', function ($data){
                return $data->opd->nama ?? "";
            })
            ->addColumn('action', function ($data) {
                if($data->username != "administrator"){
                    return view('components.datatable-action', [
                        'actions' => [
                            'delete' => [
                                'href' => route('register.asn.delete', $data->id),
                                'show' => 1
                            ]
                        ]
                    ]);
                }
            })->toJson();
        }
    }
}
