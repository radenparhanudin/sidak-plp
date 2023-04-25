<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\DashboardController;

Route::prefix('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/set-token-siasn', [DashboardController::class, 'set_token_siasn'])->name('dashboard.set-token-siasn');
    Route::post('/ubah-password', [DashboardController::class, 'ubah_password'])->name('dashboard.ubah-password');
    Route::post('/sidebar-collapse', [DashboardController::class, 'sidebar_collapse'])->name('dashboard.sidebar-collapse');
});
