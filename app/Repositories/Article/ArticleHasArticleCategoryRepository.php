<?php

namespace App\Repositories\Article;

use App\Models\ArticleHasArticleCategory;
use App\RepositoryInterfaces\Article\ArticleHasArticleCategoryRepositoryInterface;

class ArticleHasArticleCategoryRepository implements ArticleHasArticleCategoryRepositoryInterface
{
  public function findById(string $id)
  {
    try {
      return ArticleHasArticleCategory::find($id);
    } catch (\Exception $e) {
      return null;
    }
  }

  public function store(array $data)
  {
    return ArticleHasArticleCategory::create($data);
  }

  public function update(string $id, array $data)
  {
    return ArticleHasArticleCategory::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return ArticleHasArticleCategory::where('id', $id)->delete();
  }

  public function deleteByArticleId(string $articleId)
  {
    return ArticleHasArticleCategory::where('article_id', $articleId)->forceDelete();
  }
}
