<?php

namespace Modules\Absensi\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\MasterData\Entities\Opd;

class UploadFileController extends Controller
{
    public function index()
    {
        $user = User::with('opd')->find(Auth::user()->id);
        return view('absensi::upload-file.index', compact('user'));
    }

    public function upload(Request $request)
    {
        $request->validate(['file_absensi' => 'required|mimes:pdf'],[],['file_absensi' => 'File Absensi']);
        $file_absensi = Storage::disk('public')->put('file-absensi', $request->file_absensi);
        $opd = Opd::find(Auth::user()->opd_id);
        if($opd->file_absensi != null){
            Storage::disk('public')->delete($opd->file_absensi);
        }
        $opd->file_absensi = $file_absensi;
        $opd->save();
        return redirect()->back()->with('success', 'Upload file absensi berhasil');
    }
}
