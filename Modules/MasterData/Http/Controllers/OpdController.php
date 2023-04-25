<?php

namespace Modules\MasterData\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Opd;
use Yajra\DataTables\Facades\DataTables;

class OpdController extends Controller
{
    public function index()
    {
        return view('masterdata::opd.index');
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $data = Opd::query();
            return DataTables::eloquent($data)->toJson();
        }
    }
}
