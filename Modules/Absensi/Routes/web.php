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
use Modules\Absensi\Http\Controllers\AbsensiAsnController;
use Modules\Absensi\Http\Controllers\AbsensiTimSidakController;
use Modules\Absensi\Http\Controllers\UploadFileController;

Route::prefix('absensi')->middleware(['auth'])->group(function() {
    Route::prefix('asn')->middleware(['role:adminopd'])->group(function() {
        Route::prefix('asn')->group(function() {
            Route::get('/', [AbsensiAsnController::class, 'index'])->name('absensi.asn.index');
            Route::get('/edit/{id}', [AbsensiAsnController::class, 'edit'])->name('absensi.asn.edit');
            Route::put('/update/{id}', [AbsensiAsnController::class, 'update'])->name('absensi.asn.update');
            Route::get('/datatable', [AbsensiAsnController::class, 'datatable'])->name('absensi.asn.datatable');
        });
        
        Route::prefix('tim-sidak')->group(function() {
            Route::get('/', [AbsensiTimSidakController::class, 'index'])->name('absensi.tim-sidak.index');
            Route::get('/edit/{id}', [AbsensiTimSidakController::class, 'edit'])->name('absensi.tim-sidak.edit');
            Route::put('/update/{id}', [AbsensiTimSidakController::class, 'update'])->name('absensi.tim-sidak.update');
            Route::get('/datatable', [AbsensiTimSidakController::class, 'datatable'])->name('absensi.tim-sidak.datatable');
        });
        
        Route::prefix('upload-file')->group(function() {
            Route::get('/', [UploadFileController::class, 'index'])->name('absensi.upload-file.index');
            Route::post('/upload', [UploadFileController::class, 'upload'])->name('absensi.upload-file.upload');
        });
    });
    
});
