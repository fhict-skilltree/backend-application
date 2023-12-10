<?php

declare(strict_types=1);

namespace Domain\Authentication\Models;

use Laravel\Passport\Client;

class OauthClient extends Client
{
    public function skipsAuthorization()
    {
        return true;
    }
}
