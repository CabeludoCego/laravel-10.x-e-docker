<?php

namespace App\Providers;

use App\Repositories\SupportRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use SupportEloquentORM;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind(classe abstrata, classe concreta que implementa)
        $this->app->bind(
            SupportRepositoryInterface::class, 
            SupportEloquentORM::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
