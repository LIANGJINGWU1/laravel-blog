<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;

class StatusPolicy
{
    public  function  destroy(User $user, Status $status):bool
    {
        return $user->id === $status->user_id;
    }
}
