<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function isSharing($page){
        $shareGroups = self::where('page_id',$page->id)->get();

        if (count($shareGroups) > 0){
            foreach ($shareGroups as $shareGroup){
                $testUserGroup = UserGroup::where('user_id',Auth::user()->id)->where('group_id',$shareGroup->group_id);
                if ($testUserGroup !== null){
                    return true;
                }
            }
        }
        return false;
    }
}
