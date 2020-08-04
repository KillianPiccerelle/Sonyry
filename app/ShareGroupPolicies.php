<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareGroupPolicies extends Model
{
    public function member(){
        return $this->belongsTo('App\User');
    }

    public function share(){
        return $this->belongsTo('App\ShareGroup');
    }
}
