<?php

namespace App\RepositoryInterfaces\User;

use App\RepositoryInterfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
  public function findByEmail(string $email);
  public function findByEmailOrUsername(string $emailOrUsername);
}
