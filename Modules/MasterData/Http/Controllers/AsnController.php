<?php

namespace Modules\MasterData\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Entities\Asn;
use Modules\MasterData\Entities\Opd;
use Yajra\DataTables\Facades\DataTables;

class AsnController extends Controller
{
    public function index()
    {
        $opds = Opd::orderBy('nama')->get();
        return view('masterdata::asn.index', compact('opds'));
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
                    Asn::updateOrCreate([
                        'id'       => $orang['id'],
                    ],[
                        'id'       => $orang['id'],
                        'nip_baru' => $orang['nip_baru'],
                        'nama'     => $orang['nama'],
                        'opd_id'   => $request->opd_id,
                    ]);
                }
            }

            return $this->sendReponse(false, Response::HTTP_OK, "Download data berhasil");
        }
    }

    public function edit(Request $request, $id)
    {
        if($request->ajax()){
            $data = Asn::find($id);
            $data['action'] = route('asn.update', $id);
            return $this->sendReponse(false, Response::HTTP_OK, null, [$data]);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $request->validate(['opd_id' => 'required'],[],['opd_id' => 'OPD']);
            $data         = Asn::find($id);
            $data->opd_id = $request->opd_id;
            $data->save();
            return $this->sendReponse(false, Response::HTTP_OK, "Update data berhasil");
        }
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $data = Asn::query()->with('opd')->select('asns.*');
            return DataTables::eloquent($data)
            ->addColumn('opd', function ($data){
                return $data->opd->nama ?? "";
            })
            ->addColumn('action', function ($data) {
                if($data->username != "administrator"){
                    return view('components.datatable-action', [
                        'actions' => [
                            'edit' => [
                                'href' => route('asn.edit', $data->id),
                                'show' => 1
                            ]
                        ]
                    ]);
                }
            })->toJson();
        }
    }
}
