<?php

declare(strict_types=1);

namespace App\Shared\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $configRepository = $this->app->get(ConfigRepository::class);

        $this->routes(function () use ($configRepository) {
            Route::middleware('api')
                ->domain($configRepository->get('app.domain'))
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
