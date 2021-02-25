<?php

namespace App\Http\Controllers;

use App\Friend;
use App\HttpRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function destroy($id)
    {
        $apiRequest = HttpRequest::makeRequest('/profil/friend/'.$id.'/destroy');

        return redirect()->route('profil.index')->with('success','Vous venez de supprimer cette personne de votre liste d\'amis');

    }

    public function add($id)
    {
        $apiRequest = HttpRequest::makeRequest('/profil/friend/'.$id.'/add');

        if ($apiRequest->status() != 401){


            return redirect()->route('profil.index')->with('success','Vous venez d\'accepter cette demande d\'amis');
        }

        return redirect()->route('home')->with('danger','Vous ne pouvez pas effectuer cette action, cette personne vous a déjà envoyé une demande d\'amis');
    }

    public function request($id)
    {
        $apiRequest = HttpRequest::makeRequest('/profil/friend/'.$id.'/request');
        //dd($apiRequest->object());
        if ($apiRequest->status() != 401){

            $user=$apiRequest->object()->user;
            return redirect()->route('profil.index')->with('success','Vous avez envoyé une demande d\'ami à '.$user->firstName);
        }
       return redirect()->route('home')->with('danger','Vous ne pouvez pas effectuer cette action, cette personne vous a déjà envoyé une demande d\'amis');

    }
}
