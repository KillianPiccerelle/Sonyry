<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$user = Auth::user()->id;

        //dd(session()->get('api_token'));

        if(Auth::check()){
            return view('main.auth.home');
        }else{
            return view('main.ano.home');
        }
    }

    public function logout(Request $request){
        HttpRequest::makeRequest('/auth/logout','post');
        auth()->logout();
        Session()->flush();

        return Redirect::to('/');
    }
}
