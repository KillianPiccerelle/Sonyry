<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function user(){
        return $this->belongsTo('App\Group');
    }

    public function share(){
        return $this->hasMany('App\ShareGroup');
    }

    public function directories(){
        return $this->hasMany('App\ShareDirectory');
    }
}
