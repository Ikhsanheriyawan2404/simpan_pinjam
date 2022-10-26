<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{HomeController, UserController, RoleController, PinjamanController};

// Route::get('login', [LoginController::class, 'showLoginForm']);
// Route::post('login', [LoginController::class,'login'])->name('login');
// Route::get('register', [LoginController::class,'showRegisterForm'])->name('register');
// Route::post('register', [LoginController::class,'register'])->name('register');
// Route::post('logout',  [LoginController::class,'logout'])->name('logout');
Route::get('kota', [DropdownController::class, 'kota'])->name('dropdown.kota');
Route::get('kecamatan', [DropdownController::class, 'kecamatan'])->name('dropdown.kecamatan');
Route::get('desa', [DropdownController::class, 'desa'])->name('dropdown.desa');
// Route::get('districts', [DropdownController::class, 'select'])->name('dropdown.kecamatan');
// Route::get('villages', [DropdownController::class, 'select'])->name('dropdown.desa');

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'title' => 'Home'
        ]);
    })->name('dashboard');
    Route::get('profile/{id}', [HomeController::class, 'profile'])->name('profile');

    Route::resources(['users' => UserController::class]);
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['pinjaman' => PinjamanController::class]);
});
