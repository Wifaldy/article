<?php

namespace App\Services\Article;

use App\RepositoryInterfaces\Article\ArticleHasArticleCategoryRepositoryInterface;
use App\RepositoryInterfaces\Article\ArticleRepositoryInterface;

class ArticleService
{
  private $articleRepository;
  private $articleHasArticleCategoryRepository;

  public function __construct(
    ArticleRepositoryInterface $articleRepository,
    ArticleHasArticleCategoryRepositoryInterface $articleHasArticleCategoryRepository
  ) {
    $this->articleRepository = $articleRepository;
    $this->articleHasArticleCategoryRepository = $articleHasArticleCategoryRepository;
  }

  public function findAll()
  {
    $articles = collect($this->articleRepository->findAll());
    return $articles->map(function ($article) {
      return [
        'id' => $article->id,
        'title' => $article->title,
        'description' => $article->description,
        'category' => collect($article->articleHasArticleCategories)->map(function ($articleHasArticleCategory) {
          return [
            'id' => $articleHasArticleCategory->id,
            'name' => $articleHasArticleCategory->articleCategory->name
          ];
        }),
      ];
    });
  }

  public function findById(string $id)
  {
    $article =  $this->articleRepository->findById($id);
    if (!$article) throw new \Exception('Article not found', 404);
    return $article;
  }

  public function store(array $data, string $userId)
  {
    $this->articleRepository->store([
      'user_id' => $userId,
      'title' => $data['title'],
      'description' => $data['description'],
    ]);
  }

  public function addCategory(string $id, array $data)
  {
    $article = $this->articleRepository->findById($id);
    if (!$article) throw new \Exception('Article not found', 404);
    $this->articleHasArticleCategoryRepository->deleteByArticleId($id);
    foreach ($data['articleCategoryIds'] as $articleCategoryId) {
      $this->articleHasArticleCategoryRepository->store([
        'article_id' => $id,
        'article_category_id' => $articleCategoryId,
      ]);
    }
    return true;
  }

  public function update(string $id, array $data, string $userId)
  {
    $article = $this->articleRepository->findById($id);
    if (!$article) throw new \Exception('Article not found', 404);
    if ($article->user_id != $userId) throw new \Exception('Unauthorized', 401);
    return $this->articleRepository->update($id, $data);
  }

  public function delete(string $id)
  {
    $article =  $this->articleRepository->findById($id);
    if (!$article) throw new \Exception('Article not found', 404);
    return $this->articleRepository->delete($id);
  }
}
