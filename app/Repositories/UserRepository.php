<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function login($credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = request()->user();
            $token = $user->createToken('snore-apnea')->plainTextToken;
            return response()->json([
                'message' => 'User Logged In Successfully',
                'success' => true,
                'token' => $token
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid Credentials',
            'success' => false,
        ], 401);
    }

    public function register($request){
        $user = User::create([
            'name' => 'testuser',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'message' => 'User Created Successfully',
            'success' => true,
            'user' => $user
        ], 200);
    }
    public function logout()
    {
        request()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'User Logout Successfully',
            'success' => true,
        ], 200);
    }
}
