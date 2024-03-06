<?php

namespace App\Http\Controllers;

use App\Entities\DataTransferObjects\UserData;
use App\Http\Requests\User\RegisterUserRequest;
use App\UseCases\User\UserRegisterUseCase;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRegisterUseCase $userRegisterUseCase
    ){}

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $userData = new UserData(
            name: $request->getName(),
            email: $request->getEmail(),
            password: $request->getPassword()
        );

        $newUser = $this->userRegisterUseCase->register($userData);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfuly',
            'user' => $newUser
        ]);
    }
}
