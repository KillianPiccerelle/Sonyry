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
      $friend=Friend::find($id);
      $friend->delete();

      return redirect()->route('profil.index');

    }

    public function add($id)
    {
        $friend=Friend::find($id);
        $friend->is_pending=0;

        $friend->save();

        return redirect()->route('profil.index');

    }

    public function request($id)
    {
        $friend= new Friend();
        $friend->sender=Auth::user()->id;
        $friend->target=$id;
        $friend->is_pending=1;

        $friend->save();

        $user=User::find($id);
        return redirect()->route('profil.index')->with('success','Vous avez envoyé une demande d\'ami à '.$user->firstName);

    }
}
