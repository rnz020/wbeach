<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Holding\HoldingRepository;
use App\Repositories\Holding\EloquentHolding;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HoldingRepository::class, EloquentHolding::class);
    }
}
