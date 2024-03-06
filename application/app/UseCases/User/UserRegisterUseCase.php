<?php

namespace App\UseCases\User;

use App\Entities\DataTransferObjects\UserData;
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
}
