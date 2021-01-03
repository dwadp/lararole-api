<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PermissionResource;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'token' => $user->createToken($request->email)->plainTextToken,
            ]
        ]);
    }

    public function user(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'user' => new UserResource($user),
                'permissions' => PermissionResource::collection($user->allPermissions())
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => null
        ]);
    }
}
