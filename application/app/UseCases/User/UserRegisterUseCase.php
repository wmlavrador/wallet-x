<?php

namespace App\UseCases\User;

use App\Entities\DataTransferObjects\User\UserData;
use App\Entities\DataTransferObjects\User\UserPersonalTokenData;
use App\Repositories\User\UserRepositoryInterface;

class UserRegisterUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ){}

    public function register(UserData $userData): UserData
    {
        return $this->userRepository->createUser($userData);
    }

    public function createPersonalToken(UserData $userData): UserPersonalTokenData
    {
        return $this->userRepository->createPersonalToken($userData);
    }
}
