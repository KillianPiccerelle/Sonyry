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

    public function deletePolicies($policies){

        if (count($policies) > 0) {
            foreach ($policies as $policy) {
                $policy->delete();
            }
        }
    }
}
