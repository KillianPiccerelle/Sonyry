<?php


use Database\Seeders\TopicsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        //$this->call(PagesSeeder::class);
        //$this->call(CollectionsSeeder::class);
        //$this->call(FriendsSeeder::class);
        //$this->call(GroupsSeeder::class);
        //$this->call(UsersGroupsSeeder::class);
        //$this->call(NotificationsSeeder::class);
        //$this->call(InboxesSeeder::class);
        //$this->call(TopicsSeeder::class);
    }
}
