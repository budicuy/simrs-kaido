<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login
    public function login(LoginRequest $request)
    {
        //validate dengan Auth::attempt
        if (Auth::attempt($request->only('email', 'password'))) {
            //jika berhasil buat token
            $user = User::with('roles')->where('email', $request->email)->first();
            //token lama dihapus
            $user->tokens()->delete();
            //token baru di create
            $abilities = $user->getAllPermissions()->pluck('name')->toArray();
            // Filter abilities containing ':' and cut any string after '_'
            $abilities = array_map(function ($ability) {
                return explode('_', $ability)[0];
            }, array_filter($abilities, function ($ability) {
                return strpos($ability, ':') !== false;
            }));
            //create token with abilities
            $token = $user->createToken('token', $abilities)->plainTextToken;

            $roleId = $user->roles->first()->id ?? null;
            return response()->json([
            'message'      => 'Login Berhasil',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => [ // OBJEK 'user' INI SANGAT PENTING
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'roles' => (string) $roleId // Kirim ID peran sebagai string
            ]
        ]);
        } else {
            //jika gagal kirim response error
            return response()->json([
                'message' => 'Invald email or password'
            ], 401);
        }
    }

    //register
    // public function register(RegisterRequest $request)
    // {
    //     //save user to user table
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password)
    //     ]);

    //     $token = $user->createToken('token')->plainTextToken;
    //     //return token
    //     return new LoginResource([
    //         'token' => $token,
    //         'user' => $user
    //     ]);
    // }

    //logout
    public function logout(Request $request)
    {
        //hapus semua tuken by user
        $request->user()->tokens()->delete();
        //response no content
        return response()->noContent();
    }    //
}
