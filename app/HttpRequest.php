<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class HttpRequest extends Model
{
    use HasFactory;

    public static function makeRequest($url , $type = 'get' , $params = [] , $file = null)
    {

        switch ($type){
            case 'post':
                if ($file !== null){
                    $http = Http::withHeaders([
                        'Authorization' => 'Bearer ' . session()->get('api_token')
                    ])->attach('content',$file->get() , $file->getClientOriginalName())->post(env('API_BASE_URL') . $url, $params);
                }
                else{
                    $http = Http::withHeaders([
                        'Authorization' => 'Bearer ' . session()->get('api_token')
                    ])->post(env('API_BASE_URL') . $url, $params);
                }

                break;
            case 'put':
                $http = Http::withHeaders([
                    'Authorization' => 'Bearer ' . session()->get('api_token')
                ])->put(env('API_BASE_URL') . $url, $params);
                break;
            case 'delete':
                $http = Http::withHeaders([
                    'Authorization' => 'Bearer ' . session()->get('api_token')
                ])->delete(env('API_BASE_URL') . $url, $params);
                break;
            default:
                $http = Http::withHeaders([
                    'Authorization' => 'Bearer ' . session()->get('api_token')
                ])->get(env('API_BASE_URL') . $url);
                break;
        }
        return $http;
    }

}
