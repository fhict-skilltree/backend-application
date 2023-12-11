<?php

declare(strict_types=1);

namespace App\Shared\Providers;

use Domain\Authentication\Models\OauthClient;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Passport::ignoreRoutes();
        Passport::useClientModel(OauthClient::class);
    }

    public function boot(): void
    {
    }
}
