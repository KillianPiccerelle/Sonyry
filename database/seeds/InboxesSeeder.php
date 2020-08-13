<?php

use App\Inbox;
use App\Notification;
use App\User;
use Illuminate\Database\Seeder;

class InboxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inbox = new Inbox();
        $inbox->user_id = User::all()->random(1)->first()->id;
        $inbox->notification_id = Notification::all()->random(1)->first()->id;
        $inbox->save();

        $inbox = new Inbox();
        $inbox->user_id = User::all()->random(1)->first()->id;
        $inbox->notification_id = Notification::all()->random(1)->first()->id;
        $inbox->save();

        $inbox = new Inbox();
        $inbox->user_id = User::all()->random(1)->first()->id;
        $inbox->notification_id = Notification::all()->random(1)->first()->id;
        $inbox->save();

        $inbox = new Inbox();
        $inbox->user_id = User::all()->random(1)->first()->id;
        $inbox->notification_id = Notification::all()->random(1)->first()->id;
        $inbox->save();

        $inbox = new Inbox();
        $inbox->user_id = User::all()->random(1)->first()->id;
        $inbox->notification_id = Notification::all()->random(1)->first()->id;
        $inbox->save();
    }
}
