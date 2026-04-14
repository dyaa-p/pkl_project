<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // ✅ Validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // ✅ Ambil user
        $user = User::where('email', $request->email)->first();

        // ❌ Kalau salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        // 🔐 Buat token (Sanctum)
        $token = $user->createToken('auth_token')->plainTextToken;

        // ✅ Response ke Flutter
        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role, // 🔥 WAJIB ADA
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil',
        ]);
    }
}
