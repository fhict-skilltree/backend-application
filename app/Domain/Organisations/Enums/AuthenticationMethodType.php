<?php

declare(strict_types=1);

namespace Domain\Organisations\Enums;

enum AuthenticationMethodType: string
{
    case Saml2 = 'saml2';
}
