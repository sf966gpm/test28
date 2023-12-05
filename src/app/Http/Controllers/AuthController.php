<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('name', 'password'))) {
            return $this->error('', 'Не совпадают данные учетной записи.', 401);
        }
        $user = User::where($request->only('name'))->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token пользователя ' . $user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);
            return $this->success([
                'user' => $user,
                'token' => $user->createToken('API Token пользователя ' . $user->name)->plainTextToken
            ]);

        } catch (\Exception $e) {
            return $this->error('', $e->getMessage(), 401);
        }
    }

    public function logout()
    {
        return response()->json('This is myu logout method');
    }
}
