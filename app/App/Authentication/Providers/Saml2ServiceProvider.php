<?php

declare(strict_types=1);

namespace App\Authentication\Providers;

use Illuminate\Support\ServiceProvider;
use Slides\Saml2\Events\SignedIn;

class Saml2ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $events = $this->app->make('events');

        $events->listen(SignedIn::class, function (SignedIn $event) {
            $messageId = $event->getAuth()->getLastMessageId();

            logger()->info('Logged in successfully');

            //            // your own code preventing reuse of a $messageId to stop replay attacks
            //            $samlUser = $event->getSaml2User();
            //
            //            $userData = [
            //                'id' => $samlUser->getUserId(),
            //                'attributes' => $samlUser->getAttributes(),
            //                'assertion' => $samlUser->getRawSamlAssertion()
            //            ];
            //
            //            $user = // find user by ID or attribute
            //
            //                // Login a user.
            //                Auth::login($user);
        });
    }

    public function boot(): void
    {
    }
}
