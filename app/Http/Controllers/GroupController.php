<?php

namespace App\Http\Controllers;

use App\Group;
use App\Inbox;
use App\Notification;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;
use App\Http\Controllers\NotificationController;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = UserGroup::where('user_id', Auth::user()->id)->get();
        if (count($groups) > 0) {
            foreach ($groups as $group) {
                $group->members = count(UserGroup::where('group_id', $group->group_id)->get());
            }
        }

        return view('group.index', [
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $group = new Group();
        $group->name = $request->input('name');
        $group->user_id = Auth::user()->id;
        $group->save();

        $userGroup = new UserGroup();
        $userGroup->user_id = Auth::user()->id;
        $userGroup->group_id = $group->id;
        $userGroup->save();

        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);

        $members = UserGroup::where('group_id', $group->id)->where('user_id', '!=', $group->user_id)->get();
        //members dans le 2nd where on exclut du groupe la personne propriétaire et on récupère les autres


        return view('group.edit', [
            'group' => $group,
            'members' => $members
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);

        if ($request->input('name') != null) {
            $group->name = $request->input('name');
        }

        $group->save();

        return redirect()->route('group.edit', $group->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $userGroups = UserGroup::where('group_id', $group->id)->get();
        //Try if userGroups array is empty
        if (count($userGroups) > 0) {
            // if isn't empty, delete item
            foreach ($userGroups as $item)
                $item->delete();
        }
        $group->delete();
        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function exit($id)
    {

        $userGroups = UserGroup::find($id);

        NotificationController::notificationAuto("Vous venez de quitter le groupe ".$userGroups->group->name,"Bonjour, vous venez de quitter le groupe ".$userGroups->group->name.".");


        $userGroups->delete();

        return redirect()->route('group.index');
    }
}
