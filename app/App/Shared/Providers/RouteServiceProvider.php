<?php

declare(strict_types=1);

namespace App\Shared\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '0.1',
    title: 'TalentPulse API',
)]
#[OA\Server(
    url: 'https://talentpulse-backend.localhost',
    description: 'Local Development',
)]
#[OA\Components(
    responses: [
        'Ok' => new OA\Response(
            response: 200,
            description: 'OK'
        ),
        'Created' => new OA\Response(
            response: 201,
            description: 'Created',
        ),
        'NoContent' => new OA\Response(
            response: 204,
            description: 'No Content'
        ),
        'BadRequest' => new OA\Response(
            response: 400,
            description: 'Bad Request',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', description: 'The error message', type: 'string'),
                ],
                type: 'object',
            )
        ),
        'Unauthorized' => new OA\Response(
            response: 401,
            description: 'Unauthorized',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', description: 'The error message', type: 'string'),
                ],
                type: 'object',
            )
        ),
        'Forbidden' => new OA\Response(
            response: 403,
            description: 'Forbidden',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', description: 'The error message', type: 'string'),
                ],
                type: 'object',
            ),
        ),
        'NotFound' => new OA\Response(
            response: 404,
            description: 'Not found',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', description: 'The error message', type: 'string'),
                ],
                type: 'object',
            ),
        ),
    ],
)]
class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function (Router $router) {
            $router->middleware('api')
                ->group(base_path('routes/api.php'));

            $router->middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
