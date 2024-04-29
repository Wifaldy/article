<?php

namespace App\Services\Article;

use App\RepositoryInterfaces\Article\ArticleCommentRepositoryInterface;

class ArticleCommentService
{
  private $articleCommentRepository;
  private $articleService;

  public function __construct(
    ArticleCommentRepositoryInterface $articleCommentRepository,
    ArticleService $articleService
  ) {
    $this->articleCommentRepository = $articleCommentRepository;
    $this->articleService = $articleService;
  }

  public function findAll()
  {
    return $this->articleCommentRepository->findAll();
  }

  public function findAllByArticleId(string $articleId)
  {
    $this->articleService->findById($articleId);
    return $this->articleCommentRepository->findAllByArticleId($articleId);
  }

  public function findById(string $id)
  {
    $articleComment =  $this->articleCommentRepository->findById($id);
    if (!$articleComment) throw new \Exception('Article Comment not found', 404);
    return $articleComment;
  }

  public function store(array $data, string $userId, string $articleId)
  {
    $this->articleService->findById($articleId);
    $this->articleCommentRepository->store([
      'user_id' => $userId,
      'article_id' => $articleId,
      'description' => $data['description'],
    ]);
  }

  public function update(string $id, array $data)
  {
    $articleComment = $this->articleCommentRepository->findById($id);
    if (!$articleComment) throw new \Exception('Article Comment not found', 404);
    return $this->articleCommentRepository->update($id, $data);
  }

  public function delete(string $id, string $userId)
  {
    $articleComment =  $this->articleCommentRepository->findById($id);
    if (!$articleComment) throw new \Exception('Article Comment not found', 404);
    if ($articleComment->user_id != $userId) throw new \Exception('Unauthorized', 401);
    return $this->articleCommentRepository->delete($id);
  }
}
