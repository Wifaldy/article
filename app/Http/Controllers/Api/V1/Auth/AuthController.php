<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private $userService;
    //
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->userService->login($request->validated());
            return response()->json(
                [
                    'message' => "Login Success",
                    'token' => $token
                ],
                200
            );
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->userService->register($request->validated());
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }
}
