<?php

namespace App\RepositoryInterfaces\Article;

use App\RepositoryInterfaces\BaseRepositoryInterface;

interface ArticleCommentRepositoryInterface extends BaseRepositoryInterface
{
  public function findAll();
}
