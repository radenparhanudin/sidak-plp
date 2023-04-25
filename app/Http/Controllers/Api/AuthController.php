<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required'
        ],[],[
            'username' => 'Username',
            'password' => 'Password'
        ]);

        if($validator->fails()){
            return $this->sendReponse(true, Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        if (!Auth::attempt($request->only('username', 'password')))
        {
            return $this->sendReponse(true, Response::HTTP_UNAUTHORIZED, "Username dan Password salah");
        }

        $user = User::where('username', $request['username'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->sendReponse(false, Response::HTTP_OK, [
            'token_type'   => 'Bearer',
            'access_token' => $token
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendReponse(false, Response::HTTP_OK, "Logout berhasil");

    }
}
