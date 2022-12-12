<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
        // 体重
            \App\Repositories\WeightRepositoryInterface::class,
            \App\Repositories\WeightRepository::class,
        );
        $this->app->bind(
            \App\Services\WeightServiceInterface::class,
            function ($app) {
                return new \App\Services\WeightService(
                    $app->make(\App\Repositories\WeightRepositoryInterface::class)
                );
            }
        );

        // 試合体重
        $this->app->bind(
        // 試合体重
            \App\Repositories\GameWeightRepositoryInterface::class,
            \App\Repositories\GameWeightRepository::class,
        );
        $this->app->bind(
            \App\Services\GameWeightServiceInterface::class,
            function ($app) {
                return new \App\Services\GameWeightService(
                    $app->make(\App\Repositories\GameWeightRepositoryInterface::class)
                );
            },
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
