<?php

use App\Http\Controllers\Dashboard\Booking\BookingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LaporanController;
use App\Http\Controllers\Dashboard\ParkirController;
use App\Http\Controllers\Dashboard\ProsesPinjam\ProsesPinjamController;
use App\Http\Controllers\Dashboard\UserControlller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user', [UserControlller::class, 'index'])->name('dashboard.user');

    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', [LaporanController::class, 'index'])->name('dashboard.laporan');
        Route::get('/export', [LaporanController::class, 'export'])->name('dashboard.laporan.export');
    });

    Route::group(['prefix' => 'parkir'], function () {
        Route::post('/masuk', [ParkirController::class, 'parkirMasuk'])->name('dashboard.parkir.masuk');
        Route::post('/keluar', [ParkirController::class, 'parkirKeluar'])->name('dashboard.parkir.keluar');
    });
});

require __DIR__ . '/auth.php';
