<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'password'
        ];

        $messages = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password' => 'Password tidak boleh kosong'
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        // Cek apakah email dan password ada didalam database
        // Jika tidak ada, kembalikan response 401
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah!'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Berhasil login',
            'data' => new UserResource($user),
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil logout',
        ], 200);
    }
}
