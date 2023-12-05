<?php

declare(strict_types=1);

namespace App\Authentication\Saml\SignedInHandlers;

use Domain\Organisations\Models\SamlTenant;
use Domain\Users\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Slides\Saml2\Saml2User;

class FontysHogeschoolSignedInHandler implements SignedInHandlerInterface
{
    private const CLAIM_OBJECTIDENTIFIER = 'http://schemas.microsoft.com/identity/claims/objectidentifier';
    private const CLAIM_FIRST_NAME = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname';
    private const CLAIM_LAST_NAME = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname';
    private const CLAIM_EMAIL = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress';

    public function process(SamlTenant $samlTenant, Saml2User $samlUser): ?User
    {
        return User::firstOrCreate(
            [
                'remote_reference' => Arr::first($samlUser->getAttribute(self::CLAIM_OBJECTIDENTIFIER)),
                'authentication_method_id' => $samlTenant->authenticationMethod->id,
            ],
            [
                'first_name' => Arr::first($samlUser->getAttribute(self::CLAIM_FIRST_NAME)),
                'last_name' => Arr::first($samlUser->getAttribute(self::CLAIM_LAST_NAME)),
                'email' => Arr::first($samlUser->getAttribute(self::CLAIM_EMAIL)),
                'password' => Hash::make(Str::random()),
            ],
        );
    }
}
