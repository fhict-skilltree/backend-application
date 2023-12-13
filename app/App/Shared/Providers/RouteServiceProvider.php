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
    version: 'v1.0',
    title: 'TalentPulse API',
)]
#[OA\OpenApi(
    servers: [
        new OA\Server(
            url: 'https://talentpulse-backend.localhost',
            description: 'Local Development',
        ),
    ],
)]
#[OA\SecurityScheme(
    securityScheme: 'LocalhostOAuth',
    type: 'oauth2',
    flows: [
        new OA\Flow(
            authorizationUrl: 'http://talentpulse-backend.localhost/auth/methods/oauth/authorize',
            tokenUrl: 'http://talentpulse-backend.localhost/auth/methods/oauth/token',
            refreshUrl: 'http://talentpulse-backend.localhost/auth/methods/oauth/token/refresh',
            flow: 'authorizationCode',
            scopes: [],
        ),
    ],
)]
#[OA\Components(
    schemas: [
        new OA\Schema(
            schema: 'PaginatorMeta',
            properties: [
                new OA\Property(
                    property: 'meta',
                    properties: [
                        new OA\Property(
                            property: 'links',
                            properties: [
                            ],
                        ),
                        new OA\Property(property: 'current_page', type: 'integer'),
                        new OA\Property(property: 'from', type: 'integer'),
                        new OA\Property(property: 'last_page', type: 'integer'),
                        new OA\Property(property: 'path', type: 'string'),
                        new OA\Property(property: 'per_page', type: 'integer'),
                        new OA\Property(property: 'to', type: 'integer'),
                        new OA\Property(property: 'total', type: 'integer'),
                    ],
                    type: 'object',
                ),
            ],
            type: 'object'
        ),
    ],
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
    ]
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

            $router->middleware('api')
                ->prefix('v1')
                ->group(base_path('routes/api/v1.php'));

            $router->middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
