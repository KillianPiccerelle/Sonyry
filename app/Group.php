<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function share(){
        return $this->hasMany('App\ShareGroup');
    }

    public function directories(){
        return $this->hasMany('App\ShareDirectory');
    }

    public function members(){
        return $this->hasMany('App\UserGroup');
    }
}
