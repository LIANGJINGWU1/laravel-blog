<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\View\View;

class TestsController extends Controller
{
    public function index(): Factory|Application|View
    {
        return view('tests.index');
    }
}
