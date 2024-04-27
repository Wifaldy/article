<?php

namespace App\Repositories\User;

use App\Models\User;
use App\RepositoryInterfaces\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

  public function findById(string $id)
  {
    return User::find($id);
  }

  public function findByEmail(string $email)
  {
    return User::where('email', $email)->first();
  }

  public function findByEmailOrUsername(string $emailOrUsername)
  {
    return User::where('email', $emailOrUsername)->orWhere('username', $emailOrUsername)->first();
  }

  public function store(array $data)
  {
    return User::create($data);
  }

  public function update(string $id, array $data)
  {
    return User::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return User::where('id', $id)->delete();
  }
}
