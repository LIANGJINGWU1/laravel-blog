<?php

namespace App\Http\Controllers;





use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(): Factory|View|Application
    {
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required',
        ]);

        if(auth()->attempt(request(['email', 'password']))){
            $request->session()->regenerate();
            return redirect()->intended('users.show');
        }else{

        }
    }
}
