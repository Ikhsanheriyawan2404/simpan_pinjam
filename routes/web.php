<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, UserController, RoleController, PinjamanController, DropdownController, AngsuranController};

Route::get('kota', [DropdownController::class, 'kota'])->name('dropdown.kota');
Route::get('kecamatan', [DropdownController::class, 'kecamatan'])->name('dropdown.kecamatan');
Route::get('desa', [DropdownController::class, 'desa'])->name('dropdown.desa');

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
    Route::get('pinjaman/export', [PinjamanController::class, 'export'])->name('pinjaman.export');
    Route::post('pinjaman/import', [PinjamanController::class, 'import'])->name('pinjaman.import');
    Route::post('pinjaman/status/{pinjaman}', [PinjamanController::class, 'status'])->name('pinjaman.status');
    Route::post('angsuran/upload/{angsuran}', [AngsuranController::class, 'upload'])->name('angsuran.upload');
    Route::post('angsuran/status/{angsuran}', [AngsuranController::class, 'status'])->name('angsuran.status');
    Route::get('angsuran/{angsuran}/export', [AngsuranController::class, 'export'])->name('angsuran.export');
    Route::resources(['pinjaman' => PinjamanController::class]);
    Route::resources(['angsuran' => AngsuranController::class]);
});
