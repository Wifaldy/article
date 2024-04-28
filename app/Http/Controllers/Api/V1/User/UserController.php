<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userService;
    //
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->findAll();
        return response()->json([
            'message' => 'Fetch Success',
            'users' => $users
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $this->userService->store($request->validated());
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $this->userService->update($id, $request->validated());
            return response()->json(['message' => 'User updated successfully']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userService->findById($id);
            return response()->json([
                'message' => 'Fetch Success',
                'user' => $user
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode() ?: 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->userService->delete($id);
            return response()->json([
                'message' => 'Delete Success'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode() ?: 500);
        }
    }
}
