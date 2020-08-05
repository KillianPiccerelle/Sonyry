<?php

namespace App\Http\Controllers;

use App\Group;
use App\ShareDirectory;
use App\ShareGroup;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

        if (Gate::denies('can-access-group', $group)){
            return redirect()->route('home')->with('danger','Vous n\'appartenez pas à ce groupe. Par conséquent vous ne pouvez pas y acceder');
        }
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

        if (Gate::denies('can-edit-group', $group)){
            return redirect()->route('home')->with('danger','Vous n\'êtes pas propriétaire du groupe, vous n\'avez pas accès à cette page');
        }

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

        if (Gate::denies('can-edit-group', $group)){
            return redirect()->route('home')->with('danger','Vous n\'êtes pas propriétaire du groupe, vous ne pouvez pas modifier ses informations');
        }

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

        if (Gate::denies('can-edit-group', $group)){
            return redirect()->route('home')->with('danger','Vous n\'êtes pas propriétaire du groupe, vous ne pouvez pas supprimer le groupe');
        }

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

        if (Gate::denies('is-member-group', $userGroups->group)){
            return redirect()->route('home')->with('danger','Vous ne pouvez pas quitter ce groupe');
        }

        $userGroups->delete();

        return redirect()->route('group.index')->with('success','Vous avez bien quitter le groupe.');
    }

    /**
     * @param $id
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     * kick a member from a group
     */
    public function kick($id, $user_id)
    {
        $group = Group::find($id);

        if (Gate::denies('can-edit-group', $group)){
            return redirect()->route('home')->with('danger','Vous ne pouvez pas exclure cette personne');
        }

        $member = UserGroup::where('group_id', $id)->where('user_id', $user_id)->get();

        foreach ($member as $item){
            $item->delete();
        }


        return redirect()->route('group.show', $group->id)->with('success','La personne a bien été exclue !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * display the view with all shares of the group
     */
    public function share($id){

        $group = Group::find($id);

        if (Gate::denies('can-access-group', $group)){
            return redirect()->route('home')->with('danger','Vous n\'appartenez pas à ce groupe. Par conséquent vous ne pouvez pas y acceder');
        }

        return view('group.share.share',[
            'group'=>$group
        ]);
    }

}
