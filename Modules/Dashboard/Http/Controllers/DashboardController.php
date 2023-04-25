<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Modules\MasterData\Entities\Opd;

class DashboardController extends Controller
{
    public function index()
    {
        $roles  =   Auth::user()->roles->map(function($role) {
            return $role->description;
        })->implode(', ');
        
        return view('dashboard::index', compact('roles'));
    }

    public function sidebar_collapse(Request $request)
    {
        if($request->classBody == "true"){
            session()->put('classBody', 'sidebar-collapse');
        }else{
            session()->forget('classBody');
        }
    }

    public function set_token_siasn (Request $request)
    {
        $request->validate(['token_siasn' => 'required'],[], ['token_siasn' => 'Token SIASN']);
        
        $url = "https://api-siasn.bkn.go.id:8443/siasn-instansi/api/peremajaan/unor-verifikator-approval?limit=100&offset=0";
        $response = Http::withToken($request->token_siasn)->get($url);
        $response = json_decode($response, true);
        if(isset($response['data'])){
            $results = $response['data'];
            foreach ($results as $result) {
                Opd::updateOrCreate([
                    'id'   => $result['unor_verifikator_id'],
                ],[
                    'id'   => $result['unor_verifikator_id'],
                    'nama' => strtoupper($result['unor_verifikator_nama']),
                ]);
            }
        }else{
            return redirect()->back()->with('error', $response['message']);
        }
        session()->put('token_siasn', $request->token_siasn);
        return redirect()->back()->with('success', "Submit Token SIASN berhasil");
    }

    public function ubah_password(Request $request)
    {
        $request->validate(['password' => 'required'],[], ['password' => 'Password']);
        User::whereId(Auth::user()->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', "Ubah password berhasil");
    }
}
