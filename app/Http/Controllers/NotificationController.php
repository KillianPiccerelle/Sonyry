<?php

namespace App\Http\Controllers;

use App\Group;
use App\Inbox;
use App\Notification;
use App\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $notification = Notification::find($id);

        $inbox = Inbox::where('notification_id', $notification->id)->get();

        $notification->delete();
        $inbox[0]->delete();

        return redirect()->route('inbox.index');
    }

    /**
     * Auto-generation of notification
     */
    public static function notificationAuto($title, $paragraph) {

        //Génération du contenu de la notification
        $notification = new Notification();
        $notification->title = $title;
        $notification->paragraph = $paragraph;
        $notification->save();

        //Génération de la liaison de la notification avec le user en question
        $inbox = New Inbox();
        $inbox->notification_id = $notification->id;
        $inbox->user_id = Auth::user()->id;
        $inbox->save();

    }

}
