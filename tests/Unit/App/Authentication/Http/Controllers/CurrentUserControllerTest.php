<?php

declare(strict_types=1);

namespace Tests\Unit\App\Authentication\Http\Controllers;

use App\Authentication\Http\Controllers\CurrentUserController;
use App\Authentication\Http\Resources\UserResource;
use Carbon\Carbon;
use Domain\Users\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Mockery;
use PHPUnit\Framework\TestCase;

class CurrentUserControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        Carbon::setTestNow();
    }

    public function test_it_can_return_user_resource(): void
    {
        // Given
        Carbon::setTestNow(Carbon::now());

        $user = Mockery::mock(User::class);
        $user->shouldReceive('getAttribute')
            ->with('uuid')
            ->andReturn('c2227ab7-85e1-40c2-b6a1-de2a44dd0e80')
            ->once();
        $user->shouldReceive('getAttribute')
            ->with('first_name')
            ->andReturn('First name')
            ->once();
        $user->shouldReceive('getAttribute')
            ->with('last_name')
            ->andReturn('Last name')
            ->once();
        $user->shouldReceive('getAttribute')
            ->with('email')
            ->andReturn('test@example.com')
            ->once();
        $user->shouldReceive('getAttribute')
            ->with('created_at')
            ->andReturn(Carbon::now())
            ->once();
        $user->shouldReceive('getAttribute')
            ->with('updated_at')
            ->andReturn(Carbon::now())
            ->once();

        $guard = Mockery::mock(Guard::class);
        $guard->shouldReceive('user')
            ->andReturn($user);

        $authManager = Mockery::mock(AuthManager::class);
        $authManager->shouldReceive('guard')
            ->andReturn($guard);

        $request = Mockery::mock(Request::class);

        $controller = new CurrentUserController();

        // When
        $response = $controller->show($authManager);
        $responseJson = $response->toArray($request);

        // Then
        self::assertInstanceOf(UserResource::class, $response);

        self::assertEquals(
            [
                'uuid' => 'c2227ab7-85e1-40c2-b6a1-de2a44dd0e80',
                'first_name' => 'First name',
                'last_name' => 'Last name',
                'email' => 'test@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            $responseJson
        );
    }
}
