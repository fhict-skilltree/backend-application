<?php

declare(strict_types=1);

use App\Authentication\Http\Controllers\CurrentUserController;
use Illuminate\Routing\Router;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\DenyAuthorizationController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;

/** @var Router $router */

// Authentication namespace
$router->prefix('auth')
    ->name('auth.')
    ->middleware('auth:api')
    ->group(function (Router $router) {
        // Current user
        $router
            ->name('current-user')
            ->get('current-user', [CurrentUserController::class, 'show']);
    });

// Authentication Methods
$router->prefix('auth')
    ->group(function (Router $router) {
        // Methods
        $router->prefix('methods')
            ->group(function (Router $router) {
                // SAML Authentication routes
                $router->group([
                    'prefix' => 'saml2',
                    'middleware' => array_merge(['saml2.resolveTenant'], config('saml2.routesMiddleware')),
                ], function (Router $router) {
                    $router->get('/{uuid}/logout', [
                        'as' => 'saml.logout',
                        'uses' => 'Slides\Saml2\Http\Controllers\Saml2Controller@logout',
                    ]);

                    $router->get('/{uuid}/login', [
                        'as' => 'saml.login',
                        'uses' => 'Slides\Saml2\Http\Controllers\Saml2Controller@login',
                    ]);

                    $router->get('/{uuid}/metadata', [
                        'as' => 'saml.metadata',
                        'uses' => 'Slides\Saml2\Http\Controllers\Saml2Controller@metadata',
                    ]);

                    $router->post('/{uuid}/acs', [
                        'as' => 'saml.acs',
                        'uses' => 'Slides\Saml2\Http\Controllers\Saml2Controller@acs',
                    ]);

                    $router->get('/{uuid}/sls', [
                        'as' => 'saml.sls',
                        'uses' => 'Slides\Saml2\Http\Controllers\Saml2Controller@sls',
                    ]);
                });

                // OAuth
                $router->post('oauth/token', [
                    'uses' => [AccessTokenController::class, 'issueToken'],
                    'as' => 'passport.token',
                    'middleware' => 'throttle',
                ]);

                $router->get('oauth/authorize', [
                    'uses' => [AuthorizationController::class, 'authorize'],
                    'as' => 'passport.authorizations.authorize',
                    'middleware' => 'web',
                ]);

                $router->group([
                    'prefix' => 'oauth',
                    'as' => 'passport.',
                    'middleware' => [
                        'web',
                        'auth:web',
                    ],
                ], function (Router $router) {
                    $router->post('/token/refresh', [
                        'uses' => [TransientTokenController::class, 'refresh'],
                        'as' => 'token.refresh',
                    ]);

                    $router->post('/authorize', [
                        'uses' => [ApproveAuthorizationController::class, 'approve'],
                        'as' => 'authorizations.approve',
                    ]);

                    $router->delete('/authorize', [
                        'uses' => [DenyAuthorizationController::class, 'deny'],
                        'as' => 'authorizations.deny',
                    ]);

                    $router->get('/tokens', [
                        'uses' => [AuthorizedAccessTokenController::class, 'forUser'],
                        'as' => 'tokens.index',
                    ]);

                    $router->delete('/tokens/{token_id}', [
                        'uses' => [AuthorizedAccessTokenController::class, 'destroy'],
                        'as' => 'tokens.destroy',
                    ]);

                    $router->get('/clients', [
                        'uses' => [ClientController::class, 'forUser'],
                        'as' => 'clients.index',
                    ]);

                    $router->post('/clients', [
                        'uses' => [ClientController::class, 'store'],
                        'as' => 'clients.store',
                    ]);

                    $router->put('/clients/{client_id}', [
                        'uses' => [ClientController::class, 'update'],
                        'as' => 'clients.update',
                    ]);

                    $router->delete('/clients/{client_id}', [
                        'uses' => [ClientController::class, 'destroy'],
                        'as' => 'clients.destroy',
                    ]);

                    $router->get('/scopes', [
                        'uses' => [ScopeController::class, 'all'],
                        'as' => 'scopes.index',
                    ]);

                    $router->get('/personal-access-tokens', [
                        'uses' => [PersonalAccessTokenController::class, 'forUser'],
                        'as' => 'personal.tokens.index',
                    ]);

                    $router->post('/personal-access-tokens', [
                        'uses' => [PersonalAccessTokenController::class, 'store'],
                        'as' => 'personal.tokens.store',
                    ]);

                    $router->delete('/personal-access-tokens/{token_id}', [
                        'uses' => [PersonalAccessTokenController::class, 'destroy'],
                        'as' => 'personal.tokens.destroy',
                    ]);
                });
            });
    });
