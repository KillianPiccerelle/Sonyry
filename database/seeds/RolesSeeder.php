<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new Role();
        $page->libelle = 'Étudiant';
        $page->save();

        $page = new Role();
        $page->libelle = 'Professeur';
        $page->save();

        $page = new Role();
        $page->libelle = 'Administrateur';
        $page->save();
    }
}
