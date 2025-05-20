<?php

namespace App\Policies;

use App\Models\Status;

class StatusPolicy
{
    public  function  destroy(User $user, Status $status):bool
    {
        return $user->id === $status->user_id;
    }
}
