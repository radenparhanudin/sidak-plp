<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Modules\Referensi\Entities\UnitOrganisasi;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('layouts.auth');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $username = $request->username;
        if($username != "administrator"){
            return $this->loginMySAPK($request);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ],[],[
            $this->username() => 'Username',
            'password' => 'Password',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        //
    }

    public function username()
    {
        return 'username';
    }

    protected function loginMySAPK($request)
    {
        $auth   = $this->PostRequestSiasnInstansi('/mysapk/api/login', [
            'grant_type'           => "password",
            'username'             => $request->username,
            'password'             => $request->password,
            'client_id'            => "bkn-mysapk",
            'client_secret'        => "42e6c9c8-76b8-4847-82d2-ce3ba86c1870",
            'grant_type_keycloack' => "password",
        ]);
        if($auth['error']){
            throw ValidationException::withMessages(['username' => "Username dan password MySAPK tidak sesuai"]);
        }

        $login = [
            "asn_id"        => $auth['Data']['pnsId'],
            "nama"          => $auth['Data']['pnsNama'],
            "nip"           => $auth['Data']['pnsNip'],
            "instansi_id"   => $auth['Data']['instansiKerjaId'],
            "instansi_nama" => $auth['Data']['instansiKerjaNama'],
        ];

        /** Cek User */
        $user = User::whereUsername($login['nip'])->first();
        if(!isset($user)){
            throw ValidationException::withMessages(['username' => "Anda tidak terdaftar sebagai user " .  config('app.name')]);
        }

        if(!Auth::check()){
            if (Auth::login($user)) {
                session()->regenerate();
            }
        }
        session()->put('token_siasn', $auth['AccesTokenKeycloack']);
        return redirect()->route('dashboard.index');
    }
}
