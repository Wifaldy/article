<?php

namespace App\RepositoryInterfaces\Article;

use App\RepositoryInterfaces\BaseRepositoryInterface;

interface ArticleCategoryRepositoryInterface extends BaseRepositoryInterface
{
  public function findAll();
  public function findByName(string $name);
  public function findByNameAndNotId(string $name, string $id);
}
