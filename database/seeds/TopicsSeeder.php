<?php

namespace Database\Seeders;

use App\Topic;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $topic = new Topic();
            $topic->title = 'Laravel 8';
            $topic->content = 'Voici laravel 8 le futur du code';
            $topic->user_id = User::all()->random(1)->first()->id;
            $topic->save();

            $topic = new Topic();
            $topic->title = 'Angular 8';
            $topic->content = 'Voici angular 8 le futur du code';
            $topic->user_id = User::all()->random(1)->first()->id;
            $topic->save();

            $topic = new Topic();
            $topic->title = 'VueJs';
            $topic->content = 'Voici VueJs 8 le futur du code';
            $topic->user_id = User::all()->random(1)->first()->id;
            $topic->save();


    }
}
