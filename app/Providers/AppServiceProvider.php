<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\RepositoryInterfaces\User\UserRepositoryInterface;
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

        // Services
        $this->app->bind(UserService::class, function () {
            return new UserService(
                $this->app->make(UserRepositoryInterface::class)
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
