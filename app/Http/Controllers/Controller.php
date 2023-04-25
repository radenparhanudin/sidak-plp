<?php

namespace App\Http\Controllers;

use App\Traits\SiasnInstansiTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, SiasnInstansiTrait;

    // Send Response

    public function sendReponse($error, $http = Response::HTTP_OK, $message = null, $results = [])
    {
        $response['error'] = $error;
        $response['status'] = Response::$statusTexts[$http];
        if($message != null){
            $response['message'] = $message;
        }
        if(count($results) > 0){
            $response['rows']    = number_format(count($results));
            $response['results'] = $results;
        }
        return response()->json($response, $http);
    }
}
