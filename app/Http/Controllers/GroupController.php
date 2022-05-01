<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Controllers\NotificationController;
use App\HttpRequest;
use App\Inbox;
use App\InvitationGroup;
use App\Notification;
use App\ShareDirectory;
use App\ShareGroup;
use App\ShareGroupPolicies;
use App\User;
use App\UserGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\New_;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $http = HttpRequest::makeRequest('/groups');

        $groups = $http->object()->groups;

        return view('group.index', [
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $http = HttpRequest::makeRequest('/groups' , 'post' , $request->all());

        if ($http->object()){
            return redirect()->route('group.index')->with('success'  ,'Groupe créé avec succès');

        }
        return redirect()->route('group.create')->with('danger' , 'Une erreur est survenue, veuillez réessayer');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function show($id)
    {

        $http = HttpRequest::makeRequest('/groups/' . $id);

        if ($http->status() != 401 && $http->status() == 200){

            $users = $http->object()->users;

            if($users == null){
                $users = [];
            }

            return view('group.show', [
                'group' => $http->object()->group,
                'members' => $http->object()->members,
                'users' => $users

            ]);
        }

        return redirect()->route('home')->with('danger', 'Vous n\'appartenez pas à ce groupe. Par conséquent vous ne pouvez pas y acceder');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Response
     */
    public function edit(int $id)
    {
        $http = HttpRequest::makeRequest('/groups/' . $id);

        if ($http->status() != 401 && $http->status() == 200){
            return view('group.edit', [
                'group' => $http->object()->group,
                'members' => $http->object()->members,
            ]);
        }

        return redirect()->route('home')->with('danger', 'Vous n\'êtes pas propriétaire du groupe, vous n\'avez pas accès à cette page');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $http = HttpRequest::makeRequest('/groups/'.$id , 'put' , $request->all());

        if ($http->object()){

            return redirect()->route('group.show', $id)->with('success', 'Les informations du groupe ont été modifiées avec succès');
        }
        return redirect()->route('home')->with('danger', 'Vous n\'êtes pas propriétaire du groupe, vous ne pouvez pas modifier ses informations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $http = HttpRequest::makeRequest('/groups/'.$id , 'delete');

        if ($http->object()){
            return redirect()->route('group.index')->with('success', 'Groupe supprimé avec succès');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez aps effectuer cette action');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function exit($id)
    {

        $http = HttpRequest::makeRequest('/groups/exit/'.$id);

        if ($http->object()){

            return redirect()->route('group.index')->with('success', 'Vous avez bien quitté le groupe.');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas quitter ce groupe');
    }

    /**
     * @param $id
     * @param $user_id
     * @return RedirectResponse
     * kick a member from a group
     */
    public function kick($id, $user_id)
    {

        $http = HttpRequest::makeRequest('/groups/'.$id.'/kick/'.$user_id);

        if ($http->object()){
            return redirect()->route('group.show', $id)->with('success', 'La personne a bien été exclue !');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     *
     * display the view with all shares of the group
     */
    public function share($id)
    {

        $http = HttpRequest::makeRequest('/groups/' . $id);

        if ($http->status() != 401 && $http->status() == 200){
            return view('group.share.share', ['group' => $http->object()->group]);
        }
        return redirect()->route('home')->with('danger', 'Vous n\'appartenez pas à ce groupe. Par conséquent vous ne pouvez pas y acceder');

    }

    public function invite($id, $user_id)
    {
        $http = HttpRequest::makeRequest('/groups/'.$id.'/invite/'.$user_id);

        if ($http->object()){
            return redirect(route('group.show', $id))->with('success', 'Votre invitation a été envoyée avec succès');
        }
        return redirect()->route('group.show')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }

    public function accept($id, $notificationId)
    {
        $http = HttpRequest::makeRequest('/groups/'.$id.'/kick/'.$notificationId);

        if ($http->object()){
            return redirect()->route('inbox.index', $id)->with('success', 'Vous avez rejoins le groupe');
        }
        return redirect()->route('inbox.index', $id)->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }

}
