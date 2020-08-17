<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloc extends Model
{
    public function page(){
        return $this->belongsTo('App\Page');
    }
}
