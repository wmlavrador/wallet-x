<?php

namespace App\Repositories\User;

use App\Entities\User;

interface UserRepositoryInterface
{
    public function getUserById(int $userId): User;
}
