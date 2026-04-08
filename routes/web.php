<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\TransaksikasController;
use App\Http\Controllers\Backend\PembayaranController;
use App\Http\Controllers\Backend\KasmingguanController;
use App\Http\Controllers\Backend\ExportController;
use App\Http\Controllers\FrontendController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [FrontendController::class, 'index'])->middleware('auth');

Route::get('/profile/{id}', [FrontendController::class, 'profile'])->name('profile');


// =======================
// BACKEND ADMIN + SUPERADMIN
// =======================

Route::group([
    'prefix' => 'admin',
    'as' => 'backend.',
    'middleware' => ['auth','role:admin']
], function () {

    Route::get('/', [BackendController::class, 'index']);

    Route::resource('/siswa', UserController::class);

    Route::resource('/transaksi', TransaksikasController::class);

    Route::resource('/pembayaran', PembayaranController::class);

    Route::resource('/kas', KasmingguanController::class)
    ->except(['create', 'store', 'edit', 'update']);

    Route::get('/export', [ExportController::class, 'index'])->name('export.index');
});


Route::get('/select', function () {
    return view('select');
});