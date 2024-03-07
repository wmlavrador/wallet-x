<?php

namespace App\Repositories\User;

use App\Entities\DataTransferObjects\User\UserData;
use App\Entities\DataTransferObjects\User\UserPersonalTokenData;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getUserById(int $userId): UserData|null
    {
        $user = User::where('id', $userId)->first();

        if ($user) {
            return new UserData(
                name: $user->name,
                email: $user->email,
                password: null,
                id: $user->id
            );
        }

        return null;
    }

    public function createUser(UserData $userDTO): UserData
    {
        $newUser = User::create([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => Hash::make($userDTO->password)
        ]);

        return new UserData(
            name: $newUser->name,
            email: $newUser->email,
            password: null,
            id: $newUser->id
        );
    }

    /**
     * @param UserData $userData
     * @return UserPersonalTokenData
     */
    public function createPersonalToken(UserData $userData): UserPersonalTokenData
    {
        $user = User::where('email', $userData->email)->first();
        $personalToken = $user->createToken('default');

        return new UserPersonalTokenData(
            personalToken: $personalToken->plainTextToken,
            expiresAt: $personalToken->accessToken->expires_at,
            lastUsedAt: $personalToken->accessToken->last_used_at,
            name: $personalToken->accessToken->name,
            abilities: $personalToken->accessToken->abilities
        );
    }
}
