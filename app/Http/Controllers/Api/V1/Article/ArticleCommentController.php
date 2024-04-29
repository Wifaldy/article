<?php

namespace App\Http\Controllers\Api\V1\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateArticleCommentRequest;
use App\Http\Requests\Article\UpdateArticleCommentRequest;
use App\Services\Article\ArticleCommentService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticleCommentController extends Controller
{
    private $articleCommentService;
    //
    public function __construct(ArticleCommentService $articleCommentService)
    {
        $this->articleCommentService = $articleCommentService;
    }

    public function index()
    {
        $articleComments = $this->articleCommentService->findAll();
        return response()->json([
            'message' => 'Fetch Success',
            'articleComments' => $articleComments
        ]);
    }

    public function findAllByArticleId(string $articleId)
    {
        try {
            $articleComments = $this->articleCommentService->findAllByArticleId($articleId);
            return response()->json(['message' => 'Fetch Success', 'articleComments' => $articleComments]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function store(CreateArticleCommentRequest $request, string $articleId)
    {
        try {
            $userId = JWTAuth::user()->id;
            $this->articleCommentService->store($request->validated(), $userId, $articleId);
            return response()->json(['message' => 'Article Comments created successfully'], 201);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function update(UpdateArticleCommentRequest $request, string $id)
    {
        try {
            $this->articleCommentService->update($id, $request->validated());
            return response()->json(['message' => 'Article Comments updated successfully']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function show(string $id)
    {
        try {
            $articleComments = $this->articleCommentService->findById($id);
            return response()->json(['message' => 'Fetch Success', 'articleComments' => $articleComments]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $userId = JWTAuth::user()->id;
            $this->articleCommentService->delete($id, $userId);
            return response()->json(['message' => 'Delete Success']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }
}
