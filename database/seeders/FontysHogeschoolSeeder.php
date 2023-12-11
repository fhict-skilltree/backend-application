<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Authentication\Saml\TenantKey;
use Domain\Organisations\Enums\AuthenticationMethodType;
use Domain\Organisations\Models\AuthenticationMethod;
use Domain\Organisations\Models\Organisation;
use Domain\Organisations\Models\SamlTenant;
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
        /** @var AuthenticationMethod $authenticationMethod */
        $authenticationMethod = $organisation->authenticationMethods()->create([
            'type' => AuthenticationMethodType::Saml2,
            'is_active' => true,
        ]);

        // Setup SAML2 tenant
        $samlTenant = SamlTenant::create([
            'key' => TenantKey::FontysHogeschool->value,
            // Hardcoded because we use this in the local identity provider setup for Fontys Hogeschool
            'uuid' => 'a5c5d904-ed29-4462-ab6b-e73cb3270967',
            'idp_entity_id' => 'http://localhost:50201/simplesaml/saml2/idp/metadata.php',
            'idp_login_url' => 'http://localhost:50201/simplesaml/saml2/idp/SSOService.php',
            'idp_logout_url' => 'http://localhost:50201/simplesaml/saml2/idp/SingleLogoutService.php',
            'idp_x509_cert' => 'MIICmjCCAYICCQDX5sKPsYV3+jANBgkqhkiG9w0BAQsFADAPMQ0wCwYDVQQDDAR0ZXN0MB4XDTE5MTIyMzA5MDI1MVoXDTIwMDEyMjA5MDI1MVowDzENMAsGA1UEAwwEdGVzdDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAMdtDJ278DQTp84O5Nq5F8s5YOR34GFOGI2Swb/3pU7X7918lVljiKv7WVM65S59nJSyXV+fa15qoXLfsdRnq3yw0hTSTs2YDX+jl98kK3ksk3rROfYh1LIgByj4/4NeNpExgeB6rQk5Ay7YS+ARmMzEjXa0favHxu5BOdB2y6WvRQyjPS2lirT/PKWBZc04QZepsZ56+W7bd557tdedcYdY/nKI1qmSQClG2qgslzgqFOv1KCOw43a3mcK/TiiD8IXyLMJNC6OFW3xTL/BG6SOZ3dQ9rjQOBga+6GIaQsDjC4Xp7Kx+FkSvgaw0sJV8gt1mlZy+27Sza6d+hHD2pWECAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAm2fk1+gd08FQxK7TL04O8EK1f0bzaGGUxWzlh98a3Dm8+OPhVQRi/KLsFHliLC86lsZQKunYdDB+qd0KUk2oqDG6tstG/htmRYD/S/jNmt8gyPAVi11dHUqW3IvQgJLwxZtoAv6PNs188hvT1WK3VWJ4YgFKYi5XQYnR5sv69Vsr91lYAxyrIlMKahjSW1jTD3ByRfAQghsSLk6fV0OyJHyhuF1TxOVBVf8XOdaqfmvD90JGIPGtfMLPUX4m35qaGAU48PwCL7L3cRHYs9wZWc0ifXZcBENLtHYCLi5txR8c5lyHB9d3AQHzKHMFNjLswn5HsckKg83RH7+eVqHqGw==',
            'name_id_format' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
            'metadata' => [],
        ]);
        $authenticationMethod->samlTenant()->associate($samlTenant);
        $authenticationMethod->save();
    }
}
