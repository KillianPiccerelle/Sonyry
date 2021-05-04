<?php

namespace App\Http\Livewire;

use App\Categorie;
use App\HttpRequest;
use App\RoleUserPolicy;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Topic as ModelTopic;

class Topics extends Component
{
    public $categories;
    public $current = 0;
    public $topics;
    public $rolePolicy;


    public function render()
    {
        $this->categories = HttpRequest::makeRequest('/categorie/index')->object()->categories;
        $this->topics();
        $this->rolePolicy = new RoleUserPolicy();

        return view('livewire.topics');
    }

    public function switchCategorie($id)
    {
        $this->current = $id;
    }

    public function topics()
    {
        if( $this->current == 0) {
            $this->topics = HttpRequest::makeRequest('/topics')->object()->topics->data;

            if ($this->topics == null){
                $this->topics = [];
            }

        }
        else {
            $this->topics = HttpRequest::makeRequest('/topics/category/' . $this->current)->object();

            if ($this->topics == null){
                $this->topics = [];
            }
        }
    }

}
