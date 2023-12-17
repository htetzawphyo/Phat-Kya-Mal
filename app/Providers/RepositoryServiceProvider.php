<?php

namespace App\Providers;

use App\Repositories\FileRepository;
use App\Repositories\AuthorRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\FileRepositoryInterface;
use App\Interfaces\AuthorRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind( FileRepositoryInterface::class, FileRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
