<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create(): Factory|Application|View
    {
        return view('users.create');
    }

    public function show(User $user): Factory|Application|View
    {
        return view('users.show', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate( [ 'name' => 'required|max:50|unique:users|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.show', ['user' => $user])->with('success', "success");
    }

}
