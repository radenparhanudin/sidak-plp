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
use Modules\MasterData\Http\Controllers\AsnController;
use Modules\MasterData\Http\Controllers\OpdController;
use Modules\MasterData\Http\Controllers\TimSidakController;

Route::prefix('master-data')->middleware(['auth', 'role:administrator'])->group(function() {
    Route::prefix('opd')->group(function() {
        Route::get('/', [OpdController::class, 'index'])->name('opd.index');
        Route::get('/datatable', [OpdController::class, 'datatable'])->name('opd.datatable');
    });

    Route::prefix('asn')->group(function() {
        Route::get('/', [AsnController::class, 'index'])->name('asn.index');
        Route::post('/download', [AsnController::class, 'download'])->name('asn.download');
        Route::get('/datatable', [AsnController::class, 'datatable'])->name('asn.datatable');
    });

    Route::prefix('tim-sidak')->group(function() {
        Route::get('/', [TimSidakController::class, 'index'])->name('tim-sidak.index');
        Route::post('/download', [TimSidakController::class, 'download'])->name('tim-sidak.download');
        Route::delete('/delete/{id}', [TimSidakController::class, 'delete'])->name('tim-sidak.delete');
        Route::get('/datatable', [TimSidakController::class, 'datatable'])->name('tim-sidak.datatable');
    });
});
