<?php

namespace App\RepositoryInterfaces\User;

use App\RepositoryInterfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
  public function findAll();
  public function findByEmail(string $email);
  public function findByUsername(string $username = null);
  public function findByEmailOrUsername(string $emailOrUsername);
  public function findByEmailAndNotId(string $email, string $id);
  public function findByUsernameAndNotId(string $username, string $id);
}
