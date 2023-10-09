<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Participant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the participant can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
    
        return true;
    }

    /**
     * Determine whether the participant can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Participant  $model
     * @return mixed
     */
    public function view()
    {
        return false;
    }

    /**
     * Determine whether the participant can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the participant can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Participant  $model
     * @return mixed
     */
    public function update(User $user, Participant $model)
    {
        return true;
    }

    /**
     * Determine whether the participant can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Participant  $model
     * @return mixed
     */
    public function delete(User $user, Participant $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Participant  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the participant can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Participant  $model
     * @return mixed
     */
    public function restore(User $user, Participant $model)
    {
        return false;
    }

    /**
     * Determine whether the participant can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Participant  $model
     * @return mixed
     */
    public function forceDelete(User $user, Participant $model)
    {
        return false;
    }
}
