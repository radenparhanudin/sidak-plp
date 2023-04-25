<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SiasnInstansiTrait
{
    protected $baseUrl ="https://api-siasn.bkn.go.id:8443";

    public function PostRequestSiasnInstansi($path, $params = [])
    {
        $request = Http::withToken(session('token_siasn'))->baseUrl($this->baseUrl);
        $response = $request->post($path, $params);
        return json_decode($response, true);
    }

    public function getRequestSiasnInstansi($path, $params = null)
    {
        $request = Http::withToken(session('token_siasn'))->baseUrl($this->baseUrl);
        $response = (is_null($params)) ? $request->get($path) : $request->get("$path?$params");
        return json_decode($response, true);
    }

    public function getFileSiasnInstansi($path)
    {
        $response = Http::withToken(session('token_siasn'))->baseUrl($this->baseUrl)->get("/siasn-instansi/kp/usulan/dokumen?file_path=$path");
        return response($response)->header('Content-Type', $response->headers()['Content-Type'][0]);
    }
}