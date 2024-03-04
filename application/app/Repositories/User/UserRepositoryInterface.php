<?php

namespace App\Repositories\User;

use App\Entities\DataTransferObjects\UserData;
use App\Entities\User;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return User|null
     */
    public function getUserById(int $userId): UserData|null;

    /**
     * @param UserData $userDTO
     * @return User
     */
    public function createUser(UserData $userDTO): UserData;
}
