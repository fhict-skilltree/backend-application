<?php

declare(strict_types=1);

namespace App\Authentication\Listeners\Saml;

use App\Authentication\Saml\SignedInHandlers\FontysHogeschoolSignedInHandler;
use App\Authentication\Saml\TenantKey;
use Domain\Organisations\Models\SamlTenant;
use Illuminate\Auth\AuthManager;
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
            $user = (new FontysHogeschoolSignedInHandler)
                ->process($tenant, $samlUser);

            $this->authManager->guard()->login($user);

            return;
        }

        throw new RuntimeException('SAML tenant is not supported');
    }
}
