<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $http = HttpRequest::makeRequest('/dashboard');

        return view('main.auth.home' , [
            'pages' => $http->object()->pages,
            'collections' => $http->object()->collections
        ]);
    }

    public function ano()
    {
        return view('auth.login');
    }

    public function login()
    {
        $params = [
            'email'=>request()->input('email'),
            'password'=>request()->input('password')
        ];

        $http = HttpRequest::makeRequest('/auth/login','post',$params);

        if ($http->status() != 401){
            session(['api_token'=>$http->object()->access_token]);

            $http = HttpRequest::makeRequest('/auth/me','post');

            session(['id' => $http->object()->id]);

            session(['roles' => $http->object()->roles]);

            session(['firstname' => $http->object()->firstName]);

            return redirect()->route('home');
        }
        return redirect()->route('login');
    }

    public function logout(Request $request){
        HttpRequest::makeRequest('/auth/logout','post');
        auth()->logout();
        Session()->flush();

        return redirect()->route('login');
    }
}
