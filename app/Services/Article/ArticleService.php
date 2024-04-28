<?php

namespace App\Services\Article;

use App\RepositoryInterfaces\Article\ArticleRepositoryInterface;

class ArticleService
{
  private $articleRepository;

  public function __construct(ArticleRepositoryInterface $articleRepository)
  {
    $this->articleRepository = $articleRepository;
  }

  public function findAll()
  {
    return $this->articleRepository->findAll();
  }

  public function findById(string $id)
  {
    $article =  $this->articleRepository->findById($id);
    if (!$article) throw new \Exception('Article not found', 404);
    return $article;
  }

  public function store(array $data)
  {
    $this->articleRepository->store([
      'title' => $data['title'],
      'description' => $data['description'],
    ]);
  }

  public function update(string $id, array $data)
  {
    $article = $this->articleRepository->findById($id);
    if (!$article) throw new \Exception('Article not found', 404);
    return $this->articleRepository->update($id, $data);
  }

  public function delete(string $id)
  {
    $article =  $this->articleRepository->findById($id);
    if (!$article) throw new \Exception('Article not found', 404);
    return $this->articleRepository->delete($id);
  }
}
