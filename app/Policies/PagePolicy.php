<?php

namespace App\Policies;

use App\Page;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /* //Permet d'exécuter avant de vérifier. Peut être utilisé pour le partage des pages/collection groupes.
    public function before(User $user, $ability){
        if($user->AsRight()){
            return true;
        }
    }*/

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    public function access(User $user, Page $page){
        return $user->id == $page->user_id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function view(User $user, Page $page)
    {
        if ($user->id == $page->user_id){
            return true;
        }
        else{
            foreach ($page->sharesGroup as $share){
                if (count($share->sharesAuth) > 0){
                    foreach ($share->sharesAuth as $policy){
                        if ($user->id == $policy->member_id && $policy->read == 1){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        if ($user->id == $page->user_id){
            return true;
        }
        else{
            foreach ($page->sharesGroup as $share){
                if (count($share->sharesAuth) > 0){
                    foreach ($share->sharesAuth as $policy){
                        if ($user->id == $policy->member_id && $policy->write == 1){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        if ($user->id == $page->user_id){
            return true;
        }/*
        else{
            foreach ($page->sharesGroup as $share){
                if (count($share->sharesAuth) > 0){
                    foreach ($share->sharesAuth as $policy){
                        if ($user->id == $policy->member_id && $policy->execute == 1){
                            return true;
                        }
                    }
                }
            }
        }*/
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function restore(User $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function forceDelete(User $user, Page $page)
    {
        //
    }
}
