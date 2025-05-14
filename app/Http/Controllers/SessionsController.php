<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('create');
    }

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
        if (auth()->attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
//            return redirect()->route('users.show', auth()->user())->with('success', 'Logged in successfully.');
            $fallback = route('users.show', auth()->user());
            return redirect()->intended($fallback)->with('success', 'logged in successfully');

        }
        return back()->withInput()->with('danger', 'Invalid credentials.');
    }
        public function destroy(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('login')->with('success', 'Logged out successfully.');
    }
}
