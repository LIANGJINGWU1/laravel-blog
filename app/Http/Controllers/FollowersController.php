<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user): RedirectResponse
    {
        $this->authorize('follow', $user);

        if(!auth()->user()->isFollowing($user->id))
        {
            auth()->user()->follow($user);
        }

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('follow', $user);

        if(auth()->user()->isFollowing($user->id))
        {
            auth()->user()->unfollow($user);
        }

        return redirect()->route('users.show', $user->id);
    }
}
