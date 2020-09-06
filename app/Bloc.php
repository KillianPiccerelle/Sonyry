<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloc extends Model
{
    public function page(){
        return $this->belongsTo('App\Page');
    }

    public function text(){
        return $this->type = 'text';
    }

    public function script(){
        return $this->type = 'script';
    }

    public function image(){
        return $this->type = 'image';
    }

    public function video(){
        return $this->type = 'video';
    }
}
