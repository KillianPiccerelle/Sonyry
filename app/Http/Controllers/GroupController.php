<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

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
        $group = Group::find($id);
        $members = UserGroup::where('group_id', $group->id)->get();
        return view('group.show',[
            'group'=>$group,
            'members'=>$members
        ]);
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

        return redirect()->route('group.show', $group->id)->with('success','Les informations du groupe ont été modifiées avec succès');
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
        //TODO delete files from share
        $group->delete();
        return redirect()->route('group.index')->with('success','Groupe supprimé avec succès');
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

        $userGroups->delete();

        return redirect()->route('group.index')->with('success','Vous avez bien quitter le groupe.');
    }

    public function kick($id, $user_id)
    {
        $group = Group::find($id);

        $member = UserGroup::where('group_id', $id)->where('user_id', $user_id)->get();

        foreach ($member as $item){
            $item->delete();
        }


        return redirect()->route('group.show', $group->id)->with('success','La personne a bien été exclue !');
    }

    public function share($id){

        $group = Group::find($id);

        return view('group.share.share',[
            'group'=>$group
        ]);
    }

}
