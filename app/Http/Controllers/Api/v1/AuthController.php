<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\LoginRequest;
use App\Http\Requests\Api\v1\RegisterRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->save();

        return new UserResource($user);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('The provided credentials are incorrect.')],
            ]);
        }

        return response()->json([
            'access_token' => $user->createToken('personal-access-token')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth('api')->user()->tokens()->delete();

        return response()->json('', 200);
    }

    public function profile()
    {
        return new UserResource(auth('api')->user());
    }
}
