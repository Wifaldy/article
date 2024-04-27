<?php

namespace App\Services\User;

use App\RepositoryInterfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
  private $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function login(array $data)
  {
    $findByEmailOrUsername = $this->userRepository->findByEmailOrUsername($data['email'] ?? $data['username']);
    if (!$findByEmailOrUsername || !Hash::check($data['password'], $findByEmailOrUsername->password)) throw new \Exception('Invalid Email/Username/Password', 400);
    if (!$token = JWTAuth::attempt($data)) throw new \Exception('Unauthorized', 400);
    return $token;
  }

  public function store(array $data)
  {
    $findByEmail = $this->userRepository->findByEmail($data['email']);
    if ($findByEmail) throw new \Exception('Email already exists', 400);
    return $this->userRepository->store([
      'role' => $data['role'],
      'email' => $data['email'],
      'name' => $data['name'],
      'username' => $data['username'],
      'password' => $data['password'],
    ]);
  }

  public function update(string $id, array $data)
  {
    $user = $this->userRepository->findById($id);
    if (!$user) throw new \Exception('User not found', 404);
    return $this->userRepository->update($id, $data);
  }

  public function delete(string $id)
  {
    $user = $this->userRepository->findById($id);
    if (!$user) throw new \Exception('User not found', 404);
    return $this->userRepository->delete($id);
  }
}
