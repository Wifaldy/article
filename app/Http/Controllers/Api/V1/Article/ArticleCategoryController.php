<?php

namespace App\Http\Controllers\Api\V1\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateArticleCategoryRequest;
use App\Http\Requests\Article\UpdateArticleCategoryRequest;
use App\Services\Article\ArticleCategoryService;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    //
    private $articleCategoryService;
    //
    public function __construct(ArticleCategoryService $articleCategoryService)
    {
        $this->articleCategoryService = $articleCategoryService;
    }

    public function index()
    {
        $articles = $this->articleCategoryService->findAll();
        return response()->json([
            'message' => 'Fetch Success',
            'articleCategories' => $articles
        ]);
    }

    public function store(CreateArticleCategoryRequest $request)
    {
        try {
            $this->articleCategoryService->store($request->validated());
            return response()->json(['message' => 'Article Category created successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function update(UpdateArticleCategoryRequest $request, string $id)
    {
        try {
            $this->articleCategoryService->update($id, $request->validated());
            return response()->json(['message' => 'Article Category updated successfully']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function show(string $id)
    {
        try {
            $articleCategories = $this->articleCategoryService->findById($id);
            return response()->json(['message' => 'Fetch Success', 'articleCategories' => $articleCategories]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->articleCategoryService->delete($id);
            return response()->json(['message' => 'Delete Success']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }
}
