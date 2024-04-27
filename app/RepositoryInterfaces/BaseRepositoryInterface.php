<?php

namespace App\RepositoryInterfaces;

interface BaseRepositoryInterface
{
  public function findById(string $id);
  public function store(array $data);
  public function update(string $id, array $data);
  public function delete(string $id);
}
