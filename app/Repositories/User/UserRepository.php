<?php

namespace App\Repositories\User;

use App\Models\User;
use App\RepositoryInterfaces\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

  public function findAll()
  {
    return User::all();
  }

  public function findById(string $id)
  {
    try {
      return User::find($id);
    } catch (\Exception $exception) {
      return null;
    }
  }

  public function findByEmail(string $email)
  {
    return User::where('email', $email)->first();
  }

  public function findByEmailAndNotId(string $email, string $id)
  {
    return User::where('email', $email)->where('id', '!=', $id)->first();
  }

  public function findByUsernameAndNotId(string $username, string $id)
  {
    return User::where('username', $username)->where('id', '!=', $id)->first();
  }

  public function findByUsername(string $username = null)
  {
    return User::where('username', $username)->first();
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
