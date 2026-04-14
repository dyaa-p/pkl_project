<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\UserController;

// 🔐 LOGIN
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return response()->json([
            'status' => true,
            'user' => $request->user(),
        ]);
    });

    Route::get('/dashboard', [DataController::class, 'dashboard']);
    Route::get('/pemasukan', [DataController::class, 'pemasukan']);
    Route::get('/pengeluaran', [DataController::class, 'pengeluaran']);
    Route::get('/pembayaran', [DataController::class, 'pembayaran']);
    Route::get('/kas-mingguan', [DataController::class, 'kasMingguan']);

    Route::prefix('user')->group(function () {
        Route::get('/profile', [UserController::class, 'profile']);
        Route::get('/dashboard', [UserController::class, 'dashboard']);
        Route::get('/pembayaran', [UserController::class, 'pembayaran']);
        Route::get('/kas-mingguan', [UserController::class, 'kasMingguan']);
    });
});
