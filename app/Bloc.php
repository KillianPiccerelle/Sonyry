<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloc extends Model
{
    public function page(){
        return $this->belongsTo('App\Page');
    }

    public function text(){
        $this->type = 'text';
    }

    public function image(){
        $this->type = 'image';
    }
}
