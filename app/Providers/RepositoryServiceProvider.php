<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\IStudentRepository;
use App\Repositories\StudentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(IStudentRepository::class, StudentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
