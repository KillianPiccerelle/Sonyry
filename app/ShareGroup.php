<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareGroup extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function page(){
        return $this->belongsTo('App\Page');
    }

    public function sharesAuth(){
        return $this->hasMany('App\ShareGroupPolicies');
    }
}
