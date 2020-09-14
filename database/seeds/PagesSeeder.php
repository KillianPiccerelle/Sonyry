<?php

use App\Page;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new Page();
        $page->title = Str::random(10);
        $page->description = Str::random(10);
        $page->image = "default_page.png";
        $page->user_id = User::all()->random(1)->first()->id;
        $page->save();

        $page = new Page();
        $page->title = Str::random(10);
        $page->description = Str::random(10);
        $page->image = "default_page.png";
        $page->user_id = User::all()->random(1)->first()->id;
        $page->save();

        $page = new Page();
        $page->title = Str::random(10);
        $page->description = Str::random(10);
        $page->image = "default_page.png";
        $page->user_id = User::all()->random(1)->first()->id;
        $page->save();
    }
}
