<?php

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
        for($i = 0; $i < 1; $i++){
            $user = new User();
            $user->firstName = str::random(10);
            $user->name = 'risitas';
            $user->email = $user->name.'@gmail.com';
            $user->password = Hash::make('password');
            $user->description = 'etudiant';
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
}
