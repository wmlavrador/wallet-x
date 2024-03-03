<?php

namespace App\Repositories\User;

use App\Entities\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUserById(int $userId): User
    {
        return User::findOrFail($userId);
    }
}
