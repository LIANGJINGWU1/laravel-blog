<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class UsersController extends Controller
{
    public function create(): Factory|Application|View
    {
        return view('users.create');
    }
}
