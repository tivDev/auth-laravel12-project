<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    //
    public function testing(Request $request)
    {
        // Registration logic
        return response()->json(['message' => 'Testing api from AuthController']);
    }

    // Registration method
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Login method
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Incorrect password'], 401);
        }

        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $token
        ]);
    }

    // Logout method
    public function logout(Request $request)
    {
        $user = $request->user(); // Use the authenticated user from the middleware
        if ($user) {
            $user->tokens()->delete(); // Delete all tokens for the user
            return response()->json(['message' => 'Logged out successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Profile method
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function isGuestUser(Request $request)
    {
        return response()->json([
            "user" => $request->user() ? $request->user() : "Guest",
        ]);
    }
}
