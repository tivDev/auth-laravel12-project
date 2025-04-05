<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->mapApiRoutes();
    }

    /**
     * Define API Routes.
     */
    protected function mapApiRoutes(): void
    {
        collect(['routes/api.php', 'routes/api/auth.php'])->each(function ($path) {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path($path));
        });

    
    }
}
