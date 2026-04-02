<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// 🔐 LOGIN
Route::post('/login', [AuthController::class, 'login']);

// 👤 GET USER (butuh login/token)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'status' => true,
        'user' => $request->user()
    ]);
});