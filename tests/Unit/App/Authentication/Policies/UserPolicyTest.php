<?php

declare(strict_types=1);

namespace Tests\Unit\App\Authentication\Policies;

use App\Authentication\Policies\UserPolicy;
use Domain\Users\Models\User;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class UserPolicyTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_a_user_view_itself(): void
    {
        // Given
        $user = Mockery::mock(User::class);
        $user->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(302)
            ->twice();

        $policy = new UserPolicy();

        // When
        $result = $policy->view($user, $user);

        // Then
        self::assertTrue($result);
    }

    public function test_a_user_cannot_view_another_user(): void
    {
        // Given
        $user = Mockery::mock(User::class);
        $user->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(302)
            ->once();

        $userToView = Mockery::mock(User::class);
        $userToView->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(883)
            ->once();

        $policy = new UserPolicy();

        // When
        $result = $policy->view($user, $userToView);

        // Then
        self::assertFalse($result);
    }
}
