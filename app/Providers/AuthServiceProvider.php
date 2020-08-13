<?php

namespace App\Providers;

use App\ShareGroup;
use App\ShareGroupPolicies;
use App\User;
use App\UserGroup;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Groups
         */
        //Cjeck if the user is the owner of the group
        Gate::define('can-edit-group', function (User $user, $group){
           if ($user->id === $group->user_id){
               return true;
           }
           else {
               return false;
           }
        });

        //check if the user is a member of the group
        Gate::define('is-member-group', function (User $user, $group){
            if (count(UserGroup::where('user_id', $user->id)->where('group_id', $group->id)->get()) > 0){
                return true;
            }
            else{
                return false;
            }
        });

        //check if the user is the owner or a member of the group
        Gate::define('can-access-group', function (User $user, $group){
            if ($user->id === $group->user_id){
                return true;
            }
            else{
                return Gate::check('is-member-group', $group);
            }
        });



        /**
         * Groups policies
         */
        //check if the user can read the page
        Gate::define('can-read-page-policy', function (User $user, $share){
            $policy = ShareGroupPolicies::where('member_id', $user->id)->where('shareGroup_id', $share->id)->get();
            if(count($policy) > 0){
                if ($policy[0]->read === 1){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        });

        //check if the user can edit/update the page
        Gate::define('can-edit-page-policy', function (User $user, $share){
            $policy = ShareGroupPolicies::where('member_id', $user->id)->where('shareGroup_id', $share->id)->get();
            if(count($policy) > 0){
                if ($policy[0]->write === 1){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        });

        //check if the user can execute/delete the page
        Gate::define('can-execute-page-policy', function (User $user, $share){
            $policy = ShareGroupPolicies::where('member_id', $user->id)->where('shareGroup_id', $share->id)->get();
            if(count($policy) > 0){
                if ($policy[0]->execute === 1){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        });


        /**
         * Pages
         */

        //check if the user can acces to a page
        Gate::define('can-access-page', function (User $user, $page){
            if($user->id === $page->user_id){
                return true;
            }
            else{
                return false;
            }
        });

        //check if the user is the owner of the page
        Gate::define('is-page-owner', function (User $user, $page){
            if($user->id === $page->user_id){
                return true;
            }
            else{
                return false;
            }
        });



        /**
         * Collections
         */
        //check if the user is the owner of the collection
        Gate::define('is-collection-owner', function (User $user, $collection){
            if($user->id === $collection->user_id){
                return true;
            }
            else{
                return false;
            }
        });




    }
}
