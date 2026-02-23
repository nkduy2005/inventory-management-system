<?php

namespace App\Providers;

use App\Interfaces\ProductInterface;
use App\Interfaces\TransactionInterface;
use App\interfaces\UserInterface;
use App\reposities\ProductReposity;
use App\reposities\TransactionReposity;
use App\reposities\UserReposity;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserReposity::class);
        $this->app->bind(ProductInterface::class, ProductReposity::class);
        $this->app->bind(TransactionInterface::class, TransactionReposity::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scramble::afterOpenApiGenerated(function (OpenApi $open) {
            $open->secure(
                SecurityScheme::http("bearer", "BearerAuth")
            );
        });
    }
}
