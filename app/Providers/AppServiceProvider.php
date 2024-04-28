<?php

namespace App\Providers;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\User\UserRepository;
use App\RepositoryInterfaces\Article\ArticleRepositoryInterface;
use App\RepositoryInterfaces\User\UserRepositoryInterface;
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

        // Services
        $this->app->bind(UserService::class, function () {
            return new UserService(
                $this->app->make(UserRepositoryInterface::class)
            );
        });
        $this->app->bind(ArticleService::class, function () {
            return new ArticleService(
                $this->app->make(ArticleRepositoryInterface::class)
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
