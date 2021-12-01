<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [Controllers\HomeController::class, 'home'])->name('home');

Route::get('/twitch/login', [Controllers\LoginController::class, 'login'])->name('login');
Route::get('/twitch/redirect', [Controllers\LoginController::class, 'redirect']);
Route::get('/logout', [Controllers\LoginController::class, 'logOut'])->name('logout');
