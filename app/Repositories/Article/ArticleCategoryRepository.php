<?php

namespace App\Repositories\Article;

use App\Models\ArticleCategory;
use App\RepositoryInterfaces\Article\ArticleCategoryRepositoryInterface;

class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{

  public function findAll()
  {
    return ArticleCategory::all();
  }
  public function findById(string $id)
  {
    try {
      return ArticleCategory::find($id);
    } catch (\Exception $e) {
      return null;
    }
  }

  public function findByName(string $name)
  {
    return ArticleCategory::where('name', $name)->first();
  }

  public function findByNameAndNotId(string $name, string $id)
  {
    return ArticleCategory::where('name', $name)->where('id', '!=', $id)->first();
  }

  public function store(array $data)
  {
    return ArticleCategory::create($data);
  }

  public function update(string $id, array $data)
  {
    return ArticleCategory::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return ArticleCategory::where('id', $id)->delete();
  }
}
