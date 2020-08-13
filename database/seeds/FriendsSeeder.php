<?php

use App\Friend;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FriendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $friend = new Friend();
        $friend->sender = 1;
        $friend->target = 3;
        $friend->is_pending = 0;
        $friend->save();
    }
}
