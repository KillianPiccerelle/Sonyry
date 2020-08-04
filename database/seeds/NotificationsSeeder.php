<?php

use App\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification = new Notification();
        $notification->title = str::random(10);
        $notification->paragraph = str::random(50);
        $notification->save();

        $notification = new Notification();
        $notification->title = str::random(10);
        $notification->paragraph = str::random(50);
        $notification->save();

        $notification = new Notification();
        $notification->title = str::random(10);
        $notification->paragraph = str::random(50);
        $notification->save();

        $notification = new Notification();
        $notification->title = str::random(10);
        $notification->paragraph = str::random(50);
        $notification->save();

        $notification = new Notification();
        $notification->title = str::random(10);
        $notification->paragraph = str::random(50);
        $notification->save();
    }
}
