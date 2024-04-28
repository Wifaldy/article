<?php

namespace App\Providers;

use App\Repositories\Article\ArticleCategoryRepository;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Article\ArticleCommentRepository;
use App\Repositories\Article\ArticleHasArticleCategoryRepository;
use App\RepositoryInterfaces\Article\ArticleCategoryRepositoryInterface;
use App\RepositoryInterfaces\Article\ArticleCommentRepositoryInterface;
use App\RepositoryInterfaces\Article\ArticleHasArticleCategoryRepositoryInterface;
use App\RepositoryInterfaces\Article\ArticleRepositoryInterface;
use App\RepositoryInterfaces\User\UserRepositoryInterface;
use App\Services\Article\ArticleCategoryService;
use App\Services\Article\ArticleCommentService;
use App\Services\Article\ArticleService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository
        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserRepository();
        });
        $this->app->bind(ArticleRepositoryInterface::class, function () {
            return new ArticleRepository();
        });
        $this->app->bind(ArticleCategoryRepositoryInterface::class, function () {
            return new ArticleCategoryRepository();
        });
        $this->app->bind(ArticleCommentRepositoryInterface::class, function () {
            return new ArticleCommentRepository();
        });
        $this->app->bind(ArticleHasArticleCategoryRepositoryInterface::class, function () {
            return new ArticleHasArticleCategoryRepository();
        });

        // Services
        $this->app->bind(UserService::class, function () {
            return new UserService(
                $this->app->make(UserRepositoryInterface::class)
            );
        });
        $this->app->bind(ArticleService::class, function () {
            return new ArticleService(
                $this->app->make(ArticleRepositoryInterface::class),
                $this->app->make(ArticleHasArticleCategoryRepositoryInterface::class)
            );
        });
        $this->app->bind(ArticleCategoryService::class, function () {
            return new ArticleCategoryService(
                $this->app->make(ArticleCategoryRepositoryInterface::class)
            );
        });
        $this->app->bind(ArticleCommentService::class, function () {
            return new ArticleCommentService(
                $this->app->make(ArticleCommentRepositoryInterface::class),
                $this->app->make(ArticleService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
