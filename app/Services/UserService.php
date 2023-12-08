<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function registerUserData(array $validated): array
    {
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('API Token для ' . $user->email)->plainTextToken,
            'token_type' => 'Bearer'
        ];

    }

    /**
     * Отдаём массив с пользователем, токеном и его типом.
     * @param string $email
     * Проверен на существование в базе
     * @return array
     */
    public function loginUserData(string $email): array
    {
        $user = User::where($email)->first();
        return [
            'user' => $user,
            'token' => $user->createToken('API Token пользователя ' . $user->name)->plainTextToken,
            'token_type' => 'Bearer'
        ];
    }
}
