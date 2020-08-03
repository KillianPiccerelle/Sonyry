<?php

use App\Group;
use App\User;
use App\UserGroup;
use Illuminate\Database\Seeder;

class UsersGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userGroup = new UserGroup();
        $userGroup->user_id = User::all()->random(1)->first()->id;
        $userGroup->group_id = Group::all()->random(1)->first()->id;
        $userGroup->save();

        $userGroup = new UserGroup();
        $userGroup->user_id = User::all()->random(1)->first()->id;
        $userGroup->group_id = Group::all()->random(1)->first()->id;
        $userGroup->save();

        $userGroup = new UserGroup();
        $userGroup->user_id = User::all()->random(1)->first()->id;
        $userGroup->group_id = Group::all()->random(1)->first()->id;
        $userGroup->save();

        $userGroup = new UserGroup();
        $userGroup->user_id = User::all()->random(1)->first()->id;
        $userGroup->group_id = Group::all()->random(1)->first()->id;
        $userGroup->save();

    }
}
