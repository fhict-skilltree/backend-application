<?php

declare(strict_types=1);

namespace Tests\Unit\App\Authentication\Listeners\Saml;

use App\Authentication\Listeners\Saml\SignedOutListener;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Session\Session;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Slides\Saml2\Events\SignedOut;

class SignedOutListenerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_it_logs_out_the_user_and_saves_the_session(): void
    {
        // Given
        $authManagerMock = Mockery::mock(AuthManager::class);
        $sessionMock = Mockery::mock(Session::class);
        $event = Mockery::mock(SignedOut::class);
        $guard = Mockery::mock(Guard::class);

        $authManagerMock->shouldReceive('guard')
            ->andReturn($guard)
            ->once();
        $guard->shouldReceive('logout')
            ->once();
        $sessionMock->shouldReceive('save')
            ->once();

        $listener = new SignedOutListener($authManagerMock, $sessionMock);

        // When
        $listener->handle($event);
    }
}
