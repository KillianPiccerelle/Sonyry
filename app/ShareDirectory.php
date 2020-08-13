<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareDirectory extends Model
{

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function haveDirectory($user, $group){
        if (count(ShareDirectory::where('user_id', $user)->where('group_id', $group)->get()) > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
