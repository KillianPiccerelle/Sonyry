<?php

use App\Collection;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = new Collection();
        $collection->name = Str::random(10);
        $collection->description = Str::random(10);
        $collection->user_id = User::all()->random(1)->first()->id;
        $collection->image = "1594739711_index.jpg";
        $collection->save();

        $collection = new Collection();
        $collection->name = Str::random(10);
        $collection->description = Str::random(10);
        $collection->user_id = User::all()->random(1)->first()->id;
        $collection->image = "1594739711_index.jpg";
        $collection->save();

        $collection = new Collection();
        $collection->name = Str::random(10);
        $collection->description = Str::random(10);
        $collection->user_id = User::all()->random(1)->first()->id;
        $collection->image = "1594739711_index.jpg";
        $collection->save();
    }

}
