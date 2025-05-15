<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\Response;
class UserPolicy
{
    public function  viewAny(User $user):bool
    {
        return false;
    }

    public function view(User $user, User $model):bool
    {
        return false;
    }

    public function create(User $user):bool
    {
        return false;
    }

    public function update(User $user, User $model):bool
    {
        return $user->id === $model->id;
    }

    /**
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function destroy(User $user, User $model): Response
    {
        return $user->is_admin && $user->id !== $model->id
            ? Response::allow()
            : Response::deny("you don't have permission to delete this user");
    }

    public  function restore(User $user, User $model):bool
    {
            return false;
    }

    public function forceDelete(User $user, User $model):bool
    {
        return false;
    }
}
