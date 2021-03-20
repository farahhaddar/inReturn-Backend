<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Requests\UserAuthRequest;

class AuthController extends Controller
{
    public function register(UserAuthRequest $request)
    {
        if ($request->validator->fails()) {
            return error(400, $request->validator->messages());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phoneNb' => $request->phoneNb,
            'image' => "images/defult.jpeg",
            'address' => $request->address,
            'extraInfo' => $request->extraInfo,
            'city_id' => $request->city_id,
        ]);

        $token = auth('users')->login($user);

        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('users')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('users')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth('users')->user(),
        ]);
    }
}
