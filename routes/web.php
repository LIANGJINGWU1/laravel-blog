<?php

use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');

Route::get('/signup', [UserController::class, 'create'])->name('signup');
