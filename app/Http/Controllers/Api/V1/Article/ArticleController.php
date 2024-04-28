<?php

namespace App\Http\Controllers\Api\V1\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\AddCategoryRequest;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Services\Article\ArticleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            $userId = JWTAuth::user()->id;
            $this->articleService->store($request->validated(), $userId);
            return response()->json(['message' => 'Article created successfully'], 201);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function addCategory(AddCategoryRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $userId = JWTAuth::user()->id;
            $this->articleService->addCategory($id, $request->validated(), $userId);
            DB::commit();
            return response()->json(['message' => 'Category added successfully'], 201);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function update(UpdateArticleRequest $request, string $id)
    {
        try {
            $userId = JWTAuth::user()->id;
            $this->articleService->update($id, $request->validated(), $userId);
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
