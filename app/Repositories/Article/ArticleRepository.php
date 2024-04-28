<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\RepositoryInterfaces\Article\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{

  public function findAll()
  {
    return Article::all();
  }
  public function findById(string $id)
  {
    try {
      return Article::find($id);
    } catch (\Exception $e) {
      return null;
    }
  }

  public function store(array $data)
  {
    return Article::create($data);
  }

  public function update(string $id, array $data)
  {
    return Article::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return Article::where('id', $id)->delete();
  }
}
