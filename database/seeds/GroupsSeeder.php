<?php

use App\Group;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group;
        $group->name = str::random(10);
        $group->user_id = User::all()->random(1)->first()->id;
        $group->save();

        $group = new Group;
        $group->name = str::random(10);
        $group->user_id = User::all()->random(1)->first()->id;
        $group->save();

        $group = new Group;
        $group->name = str::random(10);
        $group->user_id = User::all()->random(1)->first()->id;
        $group->save();
    }
}
