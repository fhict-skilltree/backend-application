<?php

declare(strict_types=1);

namespace App\Authentication\Listeners\Saml;

use App\Authentication\Saml\TenantKey;
use Domain\Organisations\Models\SamlTenant;
use Domain\Users\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;
use Slides\Saml2\Events\SignedIn;

class SignedInListener
{
    public function __construct(private readonly AuthManager $authManager)
    {
    }

    public function handle(SignedIn $event): void
    {
        $samlUser = $event->getSaml2User();
        /** @var SamlTenant $tenant */
        $tenant = $samlUser->getTenant();

        if ($tenant->key === TenantKey::FontysHogeschool->value) {
            $user = User::firstOrCreate(
                [
                    'remote_reference' => Arr::first($samlUser->getAttribute('http://schemas.microsoft.com/identity/claims/objectidentifier')),
                    'authentication_method_id' => $tenant->authenticationMethod->id,
                ],
                [
                    'first_name' => Arr::first($samlUser->getAttribute('http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname')),
                    'last_name' => Arr::first($samlUser->getAttribute('http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname')),
                    'email' => Arr::first($samlUser->getAttribute('http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress')),
                    'password' => Hash::make(Str::random()),
                ],
            );

            $this->authManager->guard()->login($user);

            return;
        }

        throw new RuntimeException('SAML tenant is not supported');
    }
}
