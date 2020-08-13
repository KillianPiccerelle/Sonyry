<?php

namespace App\Http\Controllers;

use App\Inbox;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inboxes = Inbox::where('user_id', Auth::user()->id)->get();

        return view('inbox.index', [
            'inboxes' => $inboxes
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toTrash($id)
    {
        /** Set the notification to trash */

        $notification = Notification::find($id);
        $notification->trash = 1;
        $notification->save();

        return redirect()->route('inbox.index');
    }
}
