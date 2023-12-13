<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class OAuthClientSeeder extends Seeder
{
    public function run(ClientRepository $clientRepository): void
    {
        $client = $clientRepository->create(
            null,
            'TalentPulse Local Frontend',
            'https://talentpulse.localhost/api/auth/callback/talentpulse',
            null,
            false,
            false,
            true
        );
        $client->forceFill([
            'id' => 'f6812d1a-6a73-4d62-a708-25fdf76161f5',
            'secret' => 'qpYyQLBChY5JWrq9uMNBp5s5BrJdyBhcNG79vkdh',
        ]);
        $client->save();
    }
}
