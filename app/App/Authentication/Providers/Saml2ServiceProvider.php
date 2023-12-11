<?php

declare(strict_types=1);

namespace App\Authentication\Providers;

use App\Authentication\Listeners\Saml\SignedInListener;
use App\Authentication\Listeners\Saml\SignedOutListener;
use Illuminate\Support\ServiceProvider;
use Slides\Saml2\Events\SignedIn;
use Slides\Saml2\Events\SignedOut;

class Saml2ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $events = $this->app->make('events');

        $events->listen(SignedIn::class, SignedInListener::class);
        $events->listen(SignedOut::class, SignedOutListener::class);
    }

    public function boot(): void
    {
    }
}
