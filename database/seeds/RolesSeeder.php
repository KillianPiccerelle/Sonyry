<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Étudiant','Professeur','Administrateur','Jury'];

        foreach ($roles as $role){
            $store = new Role();
            $store->libelle = $role;
            $store->save();
        }
    }
}
