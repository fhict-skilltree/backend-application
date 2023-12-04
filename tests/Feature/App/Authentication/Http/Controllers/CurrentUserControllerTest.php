<?php

declare(strict_types=1);

namespace Tests\Feature\App\Authentication\Http\Controllers;

use Domain\Users\Models\User;
use Illuminate\Contracts\Routing\UrlGenerator;
use Tests\TestCase;

class CurrentUserControllerTest extends TestCase
{
    private UrlGenerator $urlGenerator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->urlGenerator = $this->app->get(UrlGenerator::class);
    }

    public function test_it_can_return_user_response_when_authenticated(): void
    {
        // Given
        $user = User::factory()->create();

        $endpoint = $this->urlGenerator->route('auth.current-user');

        // When
        $response = $this
            ->actingAs($user)
            ->getJson($endpoint);

        // Then
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'created_at' => $user->created_at->toISOString(),
                'updated_at' => $user->updated_at->toISOString(),
            ],
        ]);
    }

    public function test_it_returns_unauthorized_response_when_user_is_not_authenticated(): void
    {
        // Given
        $endpoint = $this->urlGenerator->route('auth.current-user');

        // When
        $response = $this->getJson($endpoint);

        // Then
        $response->assertUnauthorized();
    }
}
