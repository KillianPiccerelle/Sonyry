<?php

namespace App\Http\Controllers;

use App\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::where('user_id',Auth::user()->id)->get();
        return view('profil.profil',[
            'profil'=>$profil[0]
        ]);

    }



    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

}
