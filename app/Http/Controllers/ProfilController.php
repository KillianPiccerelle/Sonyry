<?php

namespace App\Http\Controllers;

use App\Friend;
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
        foreach ($groups as $group) {
            $group->members = count(UserGroup::where('group_id', $group->group_id)->get());
        }


        /** query that retrieves the row from the friend table if the user matches either the sender or the target */

        $friends = Friend::where('sender', Auth::user()->id)->orWhere('target', Auth::user()->id)->get();


        $count = 0;
        foreach ($friends as $friend) {

            if ($friend->is_pending === 0) {
                /** if the sender is different from the connected user then we will look for the sender*/
                if ($friend->sender !== Auth::user()->id) {
                    $friend->user = User::find($friend->sender);

                    /** otherwise the target is different from the connected user then we will search for the target */
                } elseif ($friend->target !== Auth::user()->id) {
                    $friend->user = User::find($friend->target);
                }

                /** otherwise, he has no friend  */
            } else {
                unset($friends[$count]);

            }

            $count++;

        }


        /** query that retrieves the row from the friend table if the user matches either the sender or the target */
        $friendRequests = Friend::where('sender', Auth::user()->id)->orWhere('target', Auth::user()->id)->get();


        $count = 0;
        foreach ($friendRequests as $friendRequest) {
            if ($friendRequest->is_pending === 1) {

                /** if the target is the logged in user */
                if ($friendRequest->target === Auth::user()->id) {

                    /** if the sender is different from the logged in user, the logged in user receives a friend request*/
                    if ($friendRequest->sender !== Auth::user()->id) {
                        $friendRequest->user = User::find($friendRequest->sender);

                        /** otherwise not the target which is different from the logged in user then he receives a friend request */
                    } elseif ($friendRequest->target !== Auth::user()->id) {
                        $friendRequest->user = User::find($friendRequest->target);
                    }

                } else {
                    unset($friendRequests[$count]);

                }

                /** there is no friend request */
            } else {
                unset($friendRequests[$count]);

            }

            $count++;

        }

        /** query that retrieves the row from the friend table if the user matches either the sender or the target */
        $valableUsers = User::all();
        $count = 0;
        $requests = Friend::where('sender', Auth::user()->id)->orWhere('target', Auth::user()->id)->get();

        foreach ($requests as $request) {

            if ($request->is_pending === 1) {

                /** if the sender is different from the logged in user, the logged in user receives a friend request*/
                if ($request->sender !== Auth::user()->id) {
                    $request->user = User::find($request->sender);

                    /** otherwise not the target which is different from the logged in user then he receives a friend request */
                } elseif ($request->target !== Auth::user()->id) {
                    $request->user = User::find($request->target);
                }

            } else {

                unset($requests[$count]);
            }
            $count++;
        }

        $count = 0;

        foreach ($valableUsers as $valableUser) {
            $valableUser->state = false;

            /** if the identifier is that of the connected user, then it is deleted from valid users */
            if ($valableUser->id === Auth::user()->id) {
                unset($valableUsers[$count]);
            }
            foreach ($friends as $friend) {

                /** if the identifier is that of the connected user, then it is deleted from valid users */
                if ($friend->user->id === $valableUser->id) {
                    unset($valableUsers[$count]);
                }
            }
            foreach ($requests as $request) {

                /** if the identifier is that of a valid user then he can receive a friend request */
                if ($request->user->id === $valableUser->id) {
                    $valableUser->state = true;

                }
            }
            $count++;

        }

        return view('profil.profil', [
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
        $profil = User::find($id);


        if ($request->input('newName') != null) {
            $profil->name = $request->input('newName');
        }
        if ($request->input('newFirstname') != null) {
            $profil->firstName = $request->input('newFirstname');
        }
        if ($request->input('newEmail') != null) {
            $profil->email = $request->input('newEmail');
        }
        if ($request->input('newJob') != null) {
            $profil->job = $request->input('newJob');
        }
        if ($request->input('newJobSegment') != null) {
            $profil->businessSegment = $request->input('newJobSegment');
        }
        if ($request->input('newStreet') != null) {
            $profil->streetAddress = $request->input('newStreet');
        }
        if ($request->input('newCity') != null) {
            $profil->cityAddress = $request->input('newCity');
        }
        if ($request->input('newPostalCode') != null) {
            $profil->postCodeAddress = $request->input('newPostalCode');
        }
        if ($request->input('newCountry') != null) {
            $profil->country = $request->input('newCountry');
        }
        if ($request->input('newMobilePhone') != null) {
            $profil->mobilePhone = $request->input('newMobilePhone');
        }
        if ($request->input('newWorkPhone') != null) {
            $profil->businessPhone = $request->input('newWorkPhone');
        }
        if ($request->input('newDescription') != null) {
            $profil->description = $request->input('newDescription');
        }

        $profil->save();

        return redirect()->route('profil.index')->with('success', 'Votre profil a été mis à jour');


    }

}
