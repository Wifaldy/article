<?php

use App\Http\Controllers\Api\V1\Article\ArticleCategoryController;
use App\Http\Controllers\Api\V1\Article\ArticleCommentController;
use App\Http\Controllers\Api\V1\Article\ArticleController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/health', function () {
    return "Server is up";
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'verifyRole:admin']], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'article'], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::post('/', [ArticleController::class, 'store'])->middleware(['auth', 'verifyRole:admin']);
    Route::post('/add-category/{id}', [ArticleController::class, 'addCategory'])->middleware(['auth', 'verifyRole:admin']);
    Route::put('/{id}', [ArticleController::class, 'update'])->middleware(['auth', 'verifyRole:admin']);
    Route::delete('/{id}', [ArticleController::class, 'destroy'])->middleware(['auth', 'verifyRole:admin']);
});

Route::group(['prefix' => 'article-category'], function () {
    Route::get('/', [ArticleCategoryController::class, 'index']);
    Route::get('/{id}', [ArticleCategoryController::class, 'show']);
    Route::post('/', [ArticleCategoryController::class, 'store'])->middleware(['auth', 'verifyRole:admin']);
    Route::put('/{id}', [ArticleCategoryController::class, 'update'])->middleware(['auth', 'verifyRole:admin']);
    Route::delete('/{id}', [ArticleCategoryController::class, 'destroy'])->middleware(['auth', 'verifyRole:admin']);
});

Route::group(['prefix' => 'article-comment'], function () {
    Route::get('/', [ArticleCommentController::class, 'index']);
    Route::get('/article/{id}', [ArticleCommentController::class, 'findAllByArticleId']);
    Route::get('/{id}', [ArticleCommentController::class, 'show']);
    Route::post('/{articleId}', [ArticleCommentController::class, 'store'])->middleware('auth');
    Route::put('/{id}', [ArticleCommentController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [ArticleCommentController::class, 'destroy'])->middleware('auth');
});
