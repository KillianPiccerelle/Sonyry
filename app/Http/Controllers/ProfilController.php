<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Group;
use App\HttpRequest;
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
        $apiRequest = HttpRequest::makeRequest('/profil');

        $groups = $apiRequest->object()->groups;
        $friends = $apiRequest->object()->friends;
        $friendRequests = $apiRequest->object()->friendRequests;
        $valableUsers = $apiRequest->object()->valableUsers;

        $http = HttpRequest::makeRequest('/auth/me' , 'post');

        return view('profil.profil', [
            'user' => $http->object(),
            'groups' => $groups,
            'friends' => $friends,
            'friendRequests' => $friendRequests,
            'valableUsers' => $valableUsers,

        ]);

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $params = ['newName'=>$request->input('newName'),'newFirstname'=>$request->input('newFirstname'),'newEmail'=>$request->input('newEmail'),'newJob'=>$request->input('newJob'),'newJobSegment'=>$request->input('newJobSegment'),'newStreet'=>$request->input('newStreet'),'newCity'=>$request->input('newCity'),'newPostalCode'=>$request->input('newPostalCode'),'newCountry'=>$request->input('newCountry'),'newMobilePhone'=>$request->input('newMobilePhone'),'newWorkPhone'=>$request->input('newWorkPhone'),'newDescription'=>$request->input('newDescription')];

        $apiRequest = HttpRequest::makeRequest('/profil/'.$id.'/update','put',$params);

        return redirect()->route('profil.index')->with('success', 'Votre profil a été mis à jour');


    }

}
