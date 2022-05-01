<?php

namespace App\Http\Controllers;

use App\HttpRequest;
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
        $apiRequest = HttpRequest::makeRequest('/inbox');
        //dd($apiRequest->object());
        $inboxes = $apiRequest->object()->inboxes;

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
        $apiRequest = HttpRequest::makeRequest('/inbox/'.$id.'/toTrash');

        return redirect()->route('inbox.index');
    }
}
