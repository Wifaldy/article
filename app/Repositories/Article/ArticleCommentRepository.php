<?php

namespace App\Repositories\Article;

use App\Models\ArticleComment;
use App\RepositoryInterfaces\Article\ArticleCommentRepositoryInterface;

class ArticleCommentRepository implements ArticleCommentRepositoryInterface
{
  public function findAll()
  {
    return ArticleComment::all();
  }

  public function findAllByArticleId(string $articleId)
  {
    return ArticleComment::where('article_id', $articleId)->get();
  }

  public function findById(string $id)
  {
    try {
      return ArticleComment::find($id);
    } catch (\Exception $exception) {
      return null;
    }
  }

  public function store(array $data)
  {
    return ArticleComment::create($data);
  }

  public function update(string $id, array $data)
  {
    return ArticleComment::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return ArticleComment::where('id', $id)->delete();
  }
}
