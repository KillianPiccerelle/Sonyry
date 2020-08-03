<?php

namespace App\Http\Controllers;

use App\Group;
use App\Profil;
use App\UserGroup;
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
        $groups = UserGroup::where('user_id', Auth::user()->id)->get();
        foreach ($groups as $group){
         $group->members = count(UserGroup::where('group_id', $group->group_id)->get());
        }

        return view('profil.profil', [
            'groups' =>$groups
        ]);

    }



    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

    }

}
