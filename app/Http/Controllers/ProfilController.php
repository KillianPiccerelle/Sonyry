<?php

namespace App\Http\Controllers;

use App\Group;
use App\Profil;
use App\User;
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
        $profil = User::find($id);


        if($request->input('newName') != null){
            $profil->name = $request->input('newName');
        }
        if($request->input('newFirstname') != null){
            $profil->firstName = $request->input('newFirstname');
        }
        if($request->input('newEmail') != null){
            $profil->email = $request->input('newEmail');
        }
        if($request->input('newJob') != null){
            $profil->job = $request->input('newJob');
        }
        if($request->input('newJobSegment') != null){
            $profil->businessSegment = $request->input('newJobSegment');
        }
        if($request->input('newStreet') != null){
            $profil->streetAddress = $request->input('newStreet');
        }
        if($request->input('newCity') != null){
            $profil->cityAddress = $request->input('newCity');
        }
        if($request->input('newPostalCode') != null){
            $profil->postCodeAddress = $request->input('newPostalCode');
        }
        if($request->input('newCountry') != null){
            $profil->country = $request->input('newCountry');
        }
        if($request->input('newMobilePhone') != null){
            $profil->mobilePhone = $request->input('newMobilePhone');
        }
        if($request->input('newWorkPhone') != null){
            $profil->businessPhone = $request->input('newWorkPhone');
        }
        if($request->input('newDescription') != null){
            $profil->description = $request->input('newDescription');
        }

        $profil->save();

        return redirect()->route('profil.index')->with('success','Votre profil a été mis à jour');


    }

}
