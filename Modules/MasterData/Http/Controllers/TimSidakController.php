<?php

namespace Modules\MasterData\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Entities\Opd;
use Modules\MasterData\Entities\TimSidak;
use Yajra\DataTables\Facades\DataTables;

class TimSidakController extends Controller
{
    public function index()
    {
        $opds = Opd::orderBy('nama')->get();
        return view('masterdata::tim-sidak.index', compact('opds'));
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
                    TimSidak::updateOrCreate([
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

    public function delete(Request $request, $id)
    {
        if($request->ajax()){
            TimSidak::destroy($id);
            return $this->sendReponse(false, Response::HTTP_OK, "Hapus data berhasil");
        }
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $data = TimSidak::query()->with('opd')->select('tim_sidaks.*');
            return DataTables::eloquent($data)
            ->addColumn('opd', function ($data){
                return $data->opd->nama ?? "";
            })->addColumn('action', function ($data){
                return view('components.datatable-action', [
                    'actions' => [
                        'delete' => [
                            'href' => route('tim-sidak.delete', $data->id),
                            'show' => 1
                        ]
                    ]
                ]);
            })->toJson();
        }
    }
}
