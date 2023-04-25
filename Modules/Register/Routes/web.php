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
use Modules\Register\Http\Controllers\RegisterAsnController;
use Modules\Register\Http\Controllers\RegisterTimSidakController;

Route::prefix('register')->middleware(['auth', 'role:adminopd'])->group(function() {
    Route::prefix('asn')->group(function() {
        Route::get('/', [RegisterAsnController::class, 'index'])->name('register.asn.index');
        Route::post('/download', [RegisterAsnController::class, 'download'])->name('register.asn.download');
        Route::delete('/delete/{id}', [RegisterAsnController::class, 'delete'])->name('register.asn.delete');
        Route::get('/datatable', [RegisterAsnController::class, 'datatable'])->name('register.asn.datatable');
    });
    Route::prefix('tim-sidak')->group(function() {
        Route::get('/', [RegisterTimSidakController::class, 'index'])->name('register.tim-sidak.index');
        Route::post('/download', [RegisterTimSidakController::class, 'download'])->name('register.tim-sidak.download');
        Route::delete('/delete/{id}', [RegisterTimSidakController::class, 'delete'])->name('register.tim-sidak.delete');
        Route::get('/datatable', [RegisterTimSidakController::class, 'datatable'])->name('register.tim-sidak.datatable');
    });
});
