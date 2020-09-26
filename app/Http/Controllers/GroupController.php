<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Controllers\NotificationController;
use App\Inbox;
use App\InvitationGroup;
use App\Notification;
use App\ShareDirectory;
use App\ShareGroup;
use App\ShareGroupPolicies;
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

        $users = User::all();
        $members = UserGroup::where('group_id', $group->id)->get();
        $count = 0;

        foreach ($users as $user){
            foreach ($members as $member){
                //dump($member);
                if ($user->id == $member->user_id){
                    unset($users[$count]);
                }
            }
            $count++;
        }

        if (Auth::user()->can('view', $group)) {
            $members = UserGroup::where('group_id', $group->id)->get();
            return view('group.show', [
                'group' => $group,
                'members' => $members,
                'users' => $users
            ]);
        }

        return redirect()->route('home')->with('danger', 'Vous n\'appartenez pas à ce groupe. Par conséquent vous ne pouvez pas y acceder');
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

        if (Auth::user()->can('update', $group)) {
            $members = UserGroup::where('group_id', $group->id)->where('user_id', '!=', $group->user_id)->get();
            //members dans le 2nd where on exclut du groupe la personne propriétaire et on récupère les autres


            return view('group.edit', [
                'group' => $group,
                'members' => $members
            ]);
        }

        return redirect()->route('home')->with('danger', 'Vous n\'êtes pas propriétaire du groupe, vous n\'avez pas accès à cette page');

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

        if (Auth::user()->can('update', $group)) {
            if ($request->input('name') != null) {
                $group->name = $request->input('name');
            }

            $group->save();

            return redirect()->route('group.show', $group->id)->with('success', 'Les informations du groupe ont été modifiées avec succès');
        }

        return redirect()->route('home')->with('danger', 'Vous n\'êtes pas propriétaire du groupe, vous ne pouvez pas modifier ses informations');
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

        if (Auth::user()->can('delete', $group)) {
            $members = UserGroup::where('group_id', $group->id)->get();
            //Try if userGroups array is empty
            if (count($members) > 0) {
                // if isn't empty, delete item
                foreach ($members as $member)
                    $member->delete();
            }

            //delete the share directories from the group
            $directories = ShareDirectory::where('group_id', $group->id)->get();

            if (count($directories) > 0) {
                foreach ($directories as $directory) {
                    $directory->delete();
                }
            }

            // delete the shares and the policies of the shares
            if (count($group->shares) > 0) {
                foreach ($group->shares as $share) {
                    $policies = ShareGroupPolicies::where('share_group_id', $share->id)->get();
                    if (count($policies) > 0) {
                        foreach ($policies as $policy) {
                            $policy->delete();
                        }
                    }
                    $share->delete();
                }
            }

            // and delete the group
            $group->delete();
            return redirect()->route('group.index')->with('success', 'Groupe supprimé avec succès');
        }
        return redirect()->route('home')->with('danger', 'Vous n\'êtes pas propriétaire du groupe, vous ne pouvez pas supprimer le groupe');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function exit($id)
    {

        $userGroups = UserGroup::where('user_id', Auth::user()->id)->where('group_id', $id)->get();

        $group = Group::find($id);


        if (Auth::user()->can('delete', $group)) {
            return redirect()->route('home')->with('danger', 'Vous ne pouvez pas quitter ce groupe');
        }

        $shares = $userGroups[0]->user->sharesGroups;

        //delete share and policies of the share
        $sharesGroup = new ShareGroup();
        $sharesGroup->deleteShares($shares, $group);

        //delete the directory
        $shareDirectory = new ShareDirectory();
        $directory = ShareDirectory::where('user_id', Auth::user()->id)->where('group_id', $id)->get();
        $shareDirectory->deleteDirectory($directory[0]);

        NotificationController::notificationAuto("Vous venez de quitter le groupe " . $userGroups[0]->group->name, "Bonjour, voici un mail vous informant que vous venez de quitter le groupe " . $userGroups[0]->group->name . ".");

        $userGroups[0]->delete();

        return redirect()->route('group.index')->with('success', 'Vous avez bien quitter le groupe.');
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

        if (Auth::user()->can('delete', $group)) {
            return redirect()->route('home')->with('danger', 'Vous ne pouvez pas quitter ce groupe');
        }

        $member = UserGroup::where('group_id', $id)->where('user_id', $user_id)->get();

        $shares = $member[0]->user->sharesGroups;

        //delete share and policies of the share
        $sharesGroup = new ShareGroup();
        $sharesGroup->deleteShares($shares, $group);

        //delete the directory for the shares
        $shareDirectory = new ShareDirectory();
        $directory = ShareDirectory::where('user_id', $user_id)->where('group_id', $group->id)->get();
        $shareDirectory->deleteDirectory($directory[0]);


        NotificationController::notificationAutoKick("Vous venez d'être exclue du groupe " . $group->name, "Bonjour, voici un mail vous informant que vous venez d'être exclue du groupe " . $group->name . ".", $member[0]->user->id);

        $member[0]->delete();


        return redirect()->route('group.show', $group->id)->with('success', 'La personne a bien été exclue !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * display the view with all shares of the group
     */
    public function share($id)
    {

        $group = Group::find($id);


        if (Auth::user()->can('view', $group)) {
            return view('group.share.share', [
                'group' => $group
            ]);
        }

        return redirect()->route('home')->with('danger', 'Vous n\'appartenez pas à ce groupe. Par conséquent vous ne pouvez pas y acceder');

    }

    public function invite($id, $user_id){

        $group = Group::find($id);
        if (Auth::user()->can('update', $group)){
            $invitation = new InvitationGroup();
            $invitation->user_id = $user_id ;
            $invitation->group_id = $id;
            $invitation->save();

            NotificationController::notificationAutoInviteGroup("Invitation à rejoindre " . $group->name, "Bonjour, voici un mail vous informant que vous venez d'être inviter à rejoindre " . $group->name .
                ". Vous pouvez choisir de rejoindre ce groupe en cliquant sur le bouton rejoindre ou ignorer cette notification et là supprimer.", $user_id, $group);

            return redirect(route('group.show', $group->id))->with('success', 'Votre invitation a était envoyée avec succès');
        }
        return redirect()->route('group.show')->with('danger', 'Vous n\'avez pas les droits pour inviter une personne dans ce groupe.');
    }

    public function accept($id, $user_id){

        dd('issou');

        $group = Group::find($id);
        if (Auth::user()->can('update', $group)){

            return redirect(route('group.show', $group->id))->with('success', 'Votre invitation a était envoyée avec succès');
        }
        return redirect()->route('group.show')->with('danger', 'Vous n\'avez pas les droits pour inviter une personne dans ce groupe.');
    }

}
