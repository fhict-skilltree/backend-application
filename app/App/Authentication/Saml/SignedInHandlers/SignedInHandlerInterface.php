<?php

declare(strict_types=1);

namespace App\Authentication\Saml\SignedInHandlers;

use Domain\Organisations\Models\SamlTenant;
use Domain\Users\Models\User;
use Slides\Saml2\Saml2User;

interface SignedInHandlerInterface
{
    public function process(SamlTenant $samlTenant, Saml2User $samlUser): ?User;
}
