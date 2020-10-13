<?php

namespace App\Http\Controllers;

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
        if(Auth::check()){
            $user = \App\RoleUser::where('user_id', Auth::user()->id)->get();
            $teacher =$user[0]->role_id == 2;
            $jury = $user[0]->role_id == 4;
            return view('main.auth.home', [
                'teacher'=>$teacher,
                'jury'=>$jury
            ]);
        }else{
            return view('main.ano.home');
        }
    }

    public function logout(){
        auth()->logout();
        Session()->flush();

        return Redirect::to('/');
    }
}
