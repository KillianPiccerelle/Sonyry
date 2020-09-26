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

    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function deleteShares($shares, $group){

        $policiesGroup = new ShareGroupPolicies();

        foreach ($shares as $share) {

            if ($share->group_id == $group->id) {

                $policies = ShareGroupPolicies::where('share_group_id', $share->id)->get();

                $policiesGroup->deletePolicies($policies);


                $share->delete();
            }
        }
    }
}
