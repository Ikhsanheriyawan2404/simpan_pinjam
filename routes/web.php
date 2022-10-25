<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{HomeController, UserController, RoleController, PinjamanController};

Route::get('login', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class,'login'])->name('login');
Route::post('logout',  [LoginController::class,'logout'])->name('logout');

Route::get('welcome', [HomeController::class, 'welcome']);
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('home', [
            'title' => 'Home'
        ]);
    })->name('home');


    Route::resources(['users' => UserController::class]);
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['pinjaman' => PinjamanController::class]);
});
