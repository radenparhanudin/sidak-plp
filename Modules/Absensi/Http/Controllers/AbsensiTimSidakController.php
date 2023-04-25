<?php

namespace Modules\Absensi\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\MasterData\Entities\Opd;
use Modules\MasterData\Entities\TimSidak;
use Yajra\DataTables\Facades\DataTables;

class AbsensiTimSidakController extends Controller
{
    public function index()
    {
        return view('absensi::tim-sidak.index');
    }

    public function edit(Request $request, $id)
    {
        if($request->ajax()){
            $data = TimSidak::find($id);
            $data['action'] = route('absensi.tim-sidak.update', $id);
            return $this->sendReponse(false, Response::HTTP_OK, null, [$data]);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $request->validate(['keterangan' => 'required'],[],['keterangan' => 'Keterangan']);
            if(date('Y-m-d') == config('app.tanggal_sidak')){
                $opd = Opd::find(Auth::user()->opd_id);
                if($opd->file_absensi == null){
                    $data         = TimSidak::find($id);
                    $data->keterangan = $request->keterangan;
                    $data->save();
                }
            }
            return $this->sendReponse(false, Response::HTTP_OK, "Update data berhasil");
        }
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $data = TimSidak::query()->whereOpdId(Auth::user()->opd_id);
            return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                return view('components.datatable-action', [
                    'actions' => [
                        'edit' => [
                            'href' => route('absensi.tim-sidak.edit', $data->id),
                            'show' => 1
                        ]
                    ]
                ]);
            })->toJson();
        }
    }
}