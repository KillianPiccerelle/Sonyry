<?php

namespace App\Http\Controllers;

use App\Group;
use App\HttpRequest;
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apiRequest = HttpRequest::makeRequest('/inbox/'.$id.'/destroy');
        /** Delete the notification and the link of notification with the user */

        return redirect()->route('inbox.index');
    }


}
