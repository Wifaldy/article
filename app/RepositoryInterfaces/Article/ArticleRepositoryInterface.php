<?php

namespace App\RepositoryInterfaces\Article;

use App\RepositoryInterfaces\BaseRepositoryInterface;

interface ArticleRepositoryInterface extends BaseRepositoryInterface
{
  public function findAll();
}
