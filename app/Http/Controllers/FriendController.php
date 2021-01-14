<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function destroy($id)
    {
      Friend::find($id)->delete();
      return redirect()->route('profil.index');

    }

    public function add($id)
    {

        $friend=Friend::find($id);

        if (Friend::where('target',$friend->sender)->where('sender',Auth::user()->id)->get() === null) {

            $friend->is_pending = 0;
            $friend->save();

            return redirect()->route('profil.index');
        }

        $friend->delete();

        return redirect()->route('home')->with('danger','Vous ne pouvez pas effectuer cette action, cette personne vous à déjà envoyé une demande d\'amis');
    }

    public function request($id)
    {
        if (Friend::where('target',Auth::user()->id)->where('sender',$id)->get() === null){
            $friend= new Friend();
            $friend->sender=Auth::user()->id;
            $friend->target=$id;
            $friend->is_pending=1;

            $friend->save();

            $user=User::find($id);
            return redirect()->route('profil.index')->with('success','Vous avez envoyé une demande d\'ami à '.$user->firstName);
        }
       return redirect()->route('home')->with('danger','Vous ne pouvez pas effectuer cette action, cette personne vous à déja envoyer une demande d\'amis');

    }
}
