<?php

declare(strict_types=1);

namespace App\Authentication\Listeners\Saml;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Slides\Saml2\Events\SignedOut;

class SignedOutListener
{
    public function handle(SignedOut $event): void
    {
        Auth::logout();
        Session::save();
    }
}
