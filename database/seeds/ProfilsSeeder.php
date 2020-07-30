<?php

use App\Profil;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class ProfilsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profil = new Profil();
        $profil->description = Str::random(10);
        $profil->streetAddress = Str::random(10);
        $profil->postCodeAddress = Str::random(10);
        $profil->cityAddress = Str::random(10);
        $profil->country = Str::random(10);
        $profil->mobilePhone = Str::random(10);
        $profil->businessPhone = Str::random(10);
        $profil->job= Str::random(10);
        $profil->businessSegment= Str::random(10);
        $profil->user_id = User::all()->random(1)->first()->id;
        $profil->save();

        $profil = new Profil();
        $profil->description = Str::random(10);
        $profil->streetAddress = Str::random(10);
        $profil->postCodeAddress = Str::random(10);
        $profil->cityAddress = Str::random(10);
        $profil->country = Str::random(10);
        $profil->mobilePhone = Str::random(10);
        $profil->businessPhone = Str::random(10);
        $profil->job= Str::random(10);
        $profil->businessSegment= Str::random(10);
        $profil->user_id = User::all()->random(1)->first()->id;
        $profil->save();

        $profil = new Profil();
        $profil->description = Str::random(10);
        $profil->streetAddress = Str::random(10);
        $profil->postCodeAddress = Str::random(10);
        $profil->cityAddress = Str::random(10);
        $profil->country = Str::random(10);
        $profil->mobilePhone = Str::random(10);
        $profil->businessPhone = Str::random(10);
        $profil->job= Str::random(10);
        $profil->businessSegment= Str::random(10);
        $profil->user_id = User::all()->random(1)->first()->id;
        $profil->save();
    }
}
