<?php

namespace App\Http\Livewire;

use App\Inbox;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BodyNotification extends Component
{
    public function render()
    {
        $inboxes = Inbox::where('user_id', Auth::user()->id)->get();
        return view('livewire.body-notification', [
            'inboxes' => $inboxes,
            'date' => date('H:i:s')
        ]);
    }

    public function toTrash($id)
    {
        $notification = Notification::find($id);
        $notification->trash = 1;
        $notification->save();

    }

    public function destroy($id)
    {

        $notification = Notification::find($id);
        $inbox = Inbox::where('notification_id', $notification->id)->get();

        /** Delete the notification and the link of notification with the user */
        $notification->delete();
        $inbox[0]->delete();

    }
}
