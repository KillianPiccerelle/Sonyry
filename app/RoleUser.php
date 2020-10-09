<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{

    public function user(){
        return $this->hasMany('App\User');
    }

    public function role(){
        return $this->hasMany('App\Role');
    }

}
