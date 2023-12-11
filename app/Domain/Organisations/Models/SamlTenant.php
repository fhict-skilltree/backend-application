<?php

declare(strict_types=1);

namespace Domain\Organisations\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Slides\Saml2\Models\Tenant;

class SamlTenant extends Tenant
{
    public function authenticationMethod(): HasOne
    {
        return $this->hasOne(AuthenticationMethod::class);
    }
}
