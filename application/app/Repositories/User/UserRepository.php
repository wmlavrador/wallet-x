<?php

namespace App\Repositories\User;

use App\Entities\DataTransferObjects\UserData;
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
}
