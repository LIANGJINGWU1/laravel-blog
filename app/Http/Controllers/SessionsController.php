<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create(): Factory|View|Application
    {
        return view('sessions.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('users.show', auth()->user())->with('success', 'Logged in successfully.');
        }
        return back()->withInput()->with('danger', 'Invalid credentials.');


    }
}
