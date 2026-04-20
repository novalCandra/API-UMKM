<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "message" => ['email and password not database']
            ], 403);
        }

        $token = $user->createToken('default')->plainTextToken;

        $user->token = $token;

        return response()->json([
            "status" => true,
            "message" => "succes Login",
            "data" => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            "status" => true,
            "message" => "succcess Logout"
        ]);
    }
}
