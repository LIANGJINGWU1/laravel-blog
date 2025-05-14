<?php

namespace App\Http\Policies;

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

    public function delete(User $user, User $model):bool
    {
        return false;
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
