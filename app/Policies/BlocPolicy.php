<?php

namespace App\Policies;

use App\Bloc;
use App\Page;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BlocPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bloc  $bloc
     * @return mixed
     */
    public function view(User $user, Bloc $bloc)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bloc  $bloc
     * @return mixed
     */
    public function update(User $user, Bloc $bloc)
    {
        $page = Page::find($bloc->page->id);
        if (Auth::user()->can('update',$page)){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bloc  $bloc
     * @return mixed
     */
    public function delete(User $user, Bloc $bloc)
    {
        $page = Page::find($bloc->page->id);
        if (Auth::user()->can('update',$page)){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bloc  $bloc
     * @return mixed
     */
    public function restore(User $user, Bloc $bloc)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bloc  $bloc
     * @return mixed
     */
    public function forceDelete(User $user, Bloc $bloc)
    {
        //
    }
}
