<?php

namespace App\Services\Article;

use App\RepositoryInterfaces\Article\ArticleCategoryRepositoryInterface;

class ArticleCategoryService
{
  private $articleCategoryRepository;

  public function __construct(ArticleCategoryRepositoryInterface $articleCategoryRepository)
  {
    $this->articleCategoryRepository = $articleCategoryRepository;
  }

  public function findAll()
  {
    return $this->articleCategoryRepository->findAll();
  }

  public function findById(string $id)
  {
    $articleCategory =  $this->articleCategoryRepository->findById($id);
    if (!$articleCategory) throw new \Exception('Article Category not found', 404);
    return $articleCategory;
  }

  public function store(array $data)
  {
    $articleCategory = $this->articleCategoryRepository->findByName($data['name']);
    if ($articleCategory) throw new \Exception('Article Category already exists', 400);
    $this->articleCategoryRepository->store([
      'name' => $data['name'],
    ]);
  }

  public function update(string $id, array $data)
  {
    $articleCategory = $this->articleCategoryRepository->findById($id);
    if (!$articleCategory) throw new \Exception('Article Category not found', 404);
    $findByName = $this->articleCategoryRepository->findByNameAndNotId($data['name'], $id);
    if ($findByName) throw new \Exception('Article Category already exists', 400);
    return $this->articleCategoryRepository->update($id, $data);
  }

  public function delete(string $id)
  {
    $articleCategory =  $this->articleCategoryRepository->findById($id);
    if (!$articleCategory) throw new \Exception('Article Category not found', 404);
    return $this->articleCategoryRepository->delete($id);
  }
}
