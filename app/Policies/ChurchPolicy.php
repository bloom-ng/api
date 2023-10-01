<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Church;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChurchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the church can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the church can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Church  $model
     * @return mixed
     */
    public function view(User $user, Church $model)
    {
        return true;
    }

    /**
     * Determine whether the church can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the church can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Church  $model
     * @return mixed
     */
    public function update(User $user, Church $model)
    {
        return true;
    }

    /**
     * Determine whether the church can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Church  $model
     * @return mixed
     */
    public function delete(User $user, Church $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Church  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the church can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Church  $model
     * @return mixed
     */
    public function restore(User $user, Church $model)
    {
        return false;
    }

    /**
     * Determine whether the church can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Church  $model
     * @return mixed
     */
    public function forceDelete(User $user, Church $model)
    {
        return false;
    }
}
