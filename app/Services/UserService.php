<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function registerUserData(array $validated): array
    {
        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        return $this->userData($user);

    }

    /**
     * Отдаём массив с пользователем, токеном и его типом.
     * @param string $email
     * Проверен на существование в базе
     * @return array
     */
    public function loginUserData(string $email): array
    {
        $user = User::where(['email' => $email])->first();
        return $this->userData($user);

    }

    private function userData(User $user): array
    {
        return [
            'user' => $user,
            'token' => $user->createToken('API Token для ' . $user->email)->plainTextToken,
            'token_type' => 'Bearer'
        ];
    }
}
