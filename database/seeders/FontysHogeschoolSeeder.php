<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Organisation\Enums\AuthenticationMethodType;
use Domain\Organisation\Models\AuthenticationMethod;
use Domain\Organisation\Models\Organisation;
use Illuminate\Database\Seeder;
use Slides\Saml2\Models\Tenant;

class FontysHogeschoolSeeder extends Seeder
{
    public function run(): void
    {
        $organisation = Organisation::factory()->create([
            'name' => 'Fontys Hogeschool',
        ]);

        $this->setupAuthenticationMethod($organisation);
    }

    private function setupAuthenticationMethod(Organisation $organisation): void
    {
        $organisation->authenticationMethods()->create([
            'is_active' => 'boolean',
            'type' => AuthenticationMethodType::Saml2,
        ]);

        // Setup SAML2 tenant
        Tenant::create([
            'key' => 'fontys_hogeschool',
            // Hardcoded because we use this in the local identity provider setup for Fontys Hogeschool
            'uuid' => 'a5c5d904-ed29-4462-ab6b-e73cb3270967',
            'idp_entity_id' => $entityId,
            'idp_login_url' => $loginUrl,
            'idp_logout_url' => $logoutUrl,
            'idp_x509_cert' => $x509cert,
            'relay_state_url' => $this->option('relayStateUrl'),
            'name_id_format' => $this->resolveNameIdFormat(),
            'metadata' => $metadata,
        ]);
    }
}
