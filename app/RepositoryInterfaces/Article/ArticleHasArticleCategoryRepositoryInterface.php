<?php

namespace App\RepositoryInterfaces\Article;

use App\RepositoryInterfaces\BaseRepositoryInterface;

interface ArticleHasArticleCategoryRepositoryInterface extends BaseRepositoryInterface
{
  public function deleteByArticleId(string $articleId);
}
