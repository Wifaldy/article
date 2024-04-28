<?php

namespace App\Http\Controllers\Api\V1\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Services\Article\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    private $articleService;
    //
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = $this->articleService->findAll();
        return response()->json([
            'message' => 'Fetch Success',
            'articles' => $articles
        ]);
    }

    public function store(CreateArticleRequest $request)
    {
        try {
            $article = $this->articleService->store($request->validated());
            return response()->json(['message' => 'Article created successfully'], 201);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function update(UpdateArticleRequest $request, string $id)
    {
        try {
            $article = $this->articleService->update($id, $request->validated());
            return response()->json(['message' => 'Article updated successfully']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function show(string $id)
    {
        try {
            $article = $this->articleService->findById($id);
            return response()->json(['message' => 'Fetch Success', 'article' => $article]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $article = $this->articleService->delete($id);
            return response()->json(['message' => 'Delete Success']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }
}
