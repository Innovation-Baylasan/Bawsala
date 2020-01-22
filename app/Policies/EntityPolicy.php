<?php

namespace App\Policies;

use App\Entity;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any entities.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the entity.
     *
     * @param  \App\User $user
     * @param  \App\Entity $entity
     * @return mixed
     */
    public function view(User $user, Entity $entity)
    {
        //
    }

    /**
     * Determine whether the user can create entities.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'company';
    }

    /**
     * Determine whether the user can update the entity.
     *
     * @param  \App\User $user
     * @param  \App\Entity $entity
     * @return mixed
     */
    public function update(User $user, Entity $entity)
    {
        return $entity->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the entity.
     *
     * @param  \App\User $user
     * @param  \App\Entity $entity
     * @return mixed
     */
    public function delete(User $user, Entity $entity)
    {
        //
    }

    /**
     * Determine whether the user can restore the entity.
     *
     * @param  \App\User $user
     * @param  \App\Entity $entity
     * @return mixed
     */
    public function restore(User $user, Entity $entity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the entity.
     *
     * @param  \App\User $user
     * @param  \App\Entity $entity
     * @return mixed
     */
    public function forceDelete(User $user, Entity $entity)
    {
        //
    }
}
