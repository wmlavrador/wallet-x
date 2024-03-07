<?php

namespace App\Http\Controllers;

use App\Entities\DataTransferObjects\User\UserData;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\UserAuthenticateRequest;
use App\UseCases\User\UserRegisterUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRegisterUseCase $userRegisterUseCase
    ){}

    public function index(Request $request)
    {
        return $request->user();
    }

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
            'profile' => $newUser
        ]);
    }

    public function authenticate(UserAuthenticateRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
               'message' => 'The provided credentials are incorrect.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $userData = new UserData(
            name: $request->user()->name,
            email: $request->user()->email,
            password: $request->user()->password
        );

        $accessToken = $this->userRegisterUseCase->createPersonalToken($userData);

        return response()->json($accessToken);
    }
}
