<?php

declare(strict_types=1);

namespace App\Authentication\Listeners\Saml;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Session\Session;
use Slides\Saml2\Events\SignedOut;

class SignedOutListener
{
    public function __construct(
        private readonly AuthManager $authManager,
        private readonly Session $session
    ) {
    }

    public function handle(SignedOut $event): void
    {
        $this->authManager->guard()->logout();
        $this->session->save();
    }
}
