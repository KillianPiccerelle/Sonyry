<?php

namespace App\Http\Livewire;

use App\Categorie;
use Livewire\Component;
use App\Topic as ModelTopic;

class Topics extends Component
{
    public $categories;
    public $current = 0;
    public $topics;


    public function render()
    {
        $this->categories = Categorie::all();
        $this->topics();

        return view('livewire.topic');
    }

    public function switchCategorie($id)
    {
        $this->current = $id;

    }

    public function topics()
    {
        if( $this->current == 0) {
            $this->topics = ModelTopic::all();
        }
        else {
                $this->topics = ModelTopic::where('categorie_id',$this->current)->get();
            //dd($this->topics);
        }
    }

}
