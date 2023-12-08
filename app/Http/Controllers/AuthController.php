<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request, UserService $userService): JsonResponse
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return $this->error('', 'Не совпадают данные учетной записи.', 401);
        }

        return $this->success($userService->loginUserData($validated['email']));
    }

    public function register(StoreUserRequest $request, UserService $userService): JsonResponse
    {
        $validated = $request->validated();
        return $this->success($userService->registerUserData($validated));
    }

    public function logout()
    {
        return response()->json('This is myu logout method');
    }
}
