<?php

namespace App\Policies;

use App\CollectionsPage;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionsPagePolicy
{
    use HandlesAuthorization;

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

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\CollectionsPage  $collectionsPage
     * @return mixed
     */
    public function view(User $user, CollectionsPage $collectionsPage)
    {
        return $user->id == $collectionsPage->user_id;
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
     * @param  \App\CollectionsPage  $collectionsPage
     * @return mixed
     */
    public function update(User $user, CollectionsPage $collectionsPage)
    {
        return $user->id == $collectionsPage->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CollectionsPage  $collectionsPage
     * @return mixed
     */
    public function delete(User $user, CollectionsPage $collectionsPage)
    {
        return $user->id == $collectionsPage->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\CollectionsPage  $collectionsPage
     * @return mixed
     */
    public function restore(User $user, CollectionsPage $collectionsPage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CollectionsPage  $collectionsPage
     * @return mixed
     */
    public function forceDelete(User $user, CollectionsPage $collectionsPage)
    {
        //
    }
}
