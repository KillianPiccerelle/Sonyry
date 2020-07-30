<?php

use App\Group;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->firstName = Str::random(10);
        $user->name = Str::random(10);
        $user->email = Str::random(10).'@gmail.com';
        $user->password = Hash::make('password');
        $user->description = Str::random(10);
        $user->streetAddress = Str::random(10);
        $user->postCodeAddress = Str::random(10);
        $user->cityAddress = Str::random(10);
        $user->country = Str::random(10);
        $user->mobilePhone = Str::random(10);
        $user->businessPhone = Str::random(10);
        $user->job= Str::random(10);
        $user->businessSegment= Str::random(10);
        $user->save();

        $user = new User();
        $user->name = Str::random(10);
        $user->firstName = Str::random(10);
        $user->email = Str::random(10).'@gmail.com';
        $user->password = Hash::make('password');
        $user->description = Str::random(10);
        $user->streetAddress = Str::random(10);
        $user->postCodeAddress = Str::random(10);
        $user->cityAddress = Str::random(10);
        $user->country = Str::random(10);
        $user->mobilePhone = Str::random(10);
        $user->businessPhone = Str::random(10);
        $user->job= Str::random(10);
        $user->businessSegment= Str::random(10);
        $user->save();

        $user = new User();
        $user->name = Str::random(10);
        $user->firstName = Str::random(10);
        $user->email = Str::random(10).'@gmail.com';
        $user->password = Hash::make('password');
        $user->description = Str::random(10);
        $user->streetAddress = Str::random(10);
        $user->postCodeAddress = Str::random(10);
        $user->cityAddress = Str::random(10);
        $user->country = Str::random(10);
        $user->mobilePhone = Str::random(10);
        $user->businessPhone = Str::random(10);
        $user->job= Str::random(10);
        $user->businessSegment= Str::random(10);
        $user->save();
    }
}
