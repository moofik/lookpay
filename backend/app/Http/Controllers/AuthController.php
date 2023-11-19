<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Http\Request;
use \Auth;
use \Hash;

class AuthController extends Controller
{
    use Registration;

    /**
     * Handle an authentication attempt.
     */
    public function login(LoginFormRequest $request)
    {
        if (!Auth::attempt($request->safe()->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Handle an authentication attempt.
     */
    public function register(RegisterFormRequest $request)
    {
        $registrationDto = $this->registerUser($request, random_int(100, 1000000));

        return response()->json([
            'access_token' => $registrationDto->token->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'user logged out'
        ];
    }
}
