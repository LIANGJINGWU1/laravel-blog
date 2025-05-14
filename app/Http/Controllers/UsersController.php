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

        auth()->login($user);
        return redirect()->route('users.show', ['user' => $user])->with('success', "success");
    }
    public function edit(User $user): Factory|Application|View
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data = $request->only(['name']);
        if($request->filled('password')){
            $data = $request->only(['name', 'password']);
        }
        $user->update($data);

        return redirect()->route('users.show', ['user' => $user])->with('success', "success");
    }



}
