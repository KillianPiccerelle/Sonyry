<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Page extends Model
{

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function sharesGroup(){
        return $this->hasMany('App\ShareGroup');
    }


}
