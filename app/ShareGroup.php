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


    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function directories(){
        return $this->hasMany('App\ShareDirectory');
    }

    public function deleteShares($shares, $group){

        foreach ($shares as $share) {

            if ($share->group_id == $group->id) {

                $share->delete();
            }
        }
    }
}
