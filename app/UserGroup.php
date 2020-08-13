<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function Group(){
        return $this->belongsTo('App\Group');
    }

}
