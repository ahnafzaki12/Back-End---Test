<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * LOGIN
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username atau password salah',
            ], 401);
        }

        $admin = $request->user();

        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'admin' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'username' => $admin->username,
                    'phone' => $admin->phone,
                    'email' => $admin->email,
                ]
            ]
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logout berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal logout, token tidak valid',
            ], 401);
        }
    }

    public function updateProfile(Request $request)
    {
        $admin = $request->user();

        // Validasi: Pastikan tabel diarahkan ke 'users'
        $validator = Validator::make($request->all(), [
            'name'     => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255|unique:users,username,' . $admin->id,
            'phone'    => 'nullable|string|max:20',
            'email'    => 'sometimes|required|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Update data jika ada di request
        if ($request->filled('name'))     $admin->name = $request->name;
        if ($request->filled('username')) $admin->username = $request->username;
        if ($request->filled('phone'))    $admin->phone = $request->phone;
        if ($request->filled('email'))    $admin->email = $request->email;
        if ($request->filled('password')) $admin->password = bcrypt($request->password);

        $admin->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Profile berhasil diperbarui',
            'data'    => [
                'id'       => $admin->id,
                'name'     => $admin->name,
                'username' => $admin->username,
                'phone'    => $admin->phone,
                'email'    => $admin->email,
            ]
        ]);
    }
}
