<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Authentication\Saml\TenantKey;
use Domain\Courses\Models\Course;
use Domain\Organisations\Enums\AuthenticationMethodType;
use Domain\Organisations\Models\AuthenticationMethod;
use Domain\Organisations\Models\Organisation;
use Domain\Organisations\Models\SamlTenant;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class FontysHogeschoolSeeder extends Seeder
{
    private Collection $students;

    public function __construct()
    {
        $this->students = new Collection();
    }

    public function run(): void
    {
        $organisation = Organisation::factory()->create([
            'name' => 'Fontys Hogeschool',
        ]);

        $this->setupAuthenticationMethod($organisation);
        $this->createUsers($organisation);
        $this->createCourses();
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

    private function createUsers(Organisation $organisation): void
    {
        $femke = User::create([
            'uuid' => 'ce120cca-166b-4d68-a255-4587c025de6a',
            'remote_reference' => 'f2d75402-e1ae-40fe-8cc9-98ca1ab9cd5e',
            'first_name' => 'Femke',
            'last_name' => 'Student',
            'email' => '101@student.fontys.nl',
            'password' => Hash::make('TestTest0!'),
            'authentication_method_id' => $organisation->authenticationMethods()->first()->id,
        ]);

        $this->students->add($femke);
    }

    private function createCourses(): void
    {
        /** @var Course $semesterTwo */
        $semesterTwo = Course::factory()->create([
            'uuid' => '9ad59568-b12c-42d7-94a5-05a46e14c13a',
            'title' => 'Semester 2',
            'content' => 'In dit overzicht vind je de skilltree voor je huidige opleiding. In de skilltree vind je een selectie aan vaardigheden die je in dit semester kunt gaan aantonen. De skilltree doorloop je vanaf boven naar bedenden. Het is de bedoeling dat je zelf een keuze maakt aan welke vaardigheden jij wilt werken. Wanneer je denk dat je een vaardigheid voldoende hebt aangetoond, kun je dit voor jezelf afvinken. De docent zal in jouw periodieke beoordelingen vaststellen op welk niveau jij de leeruitkomsten aantoond.',
        ]);
        $semesterTwo->enrolledUsers()->sync($this->students->pluck('id'));
    }
}
