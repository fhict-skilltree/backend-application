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
use Slides\Saml2\Http\Controllers\Saml2Controller;

/** @var Router $router */

// Authentication namespace
$router->prefix('auth')
    ->name('auth.')
    ->middleware(['api', 'auth:api'])
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
                $router
                    ->prefix('saml2')
                    ->middleware(array_merge(['saml2.resolveTenant'], config('saml2.routesMiddleware')))
                    ->group(function (Router $router) {
                        $router->get('/{uuid}/logout', [Saml2Controller::class, 'logout'])
                            ->name('saml.logout');

                        $router->get('/{uuid}/login', [Saml2Controller::class, 'login'])
                            ->name('saml.login');

                        $router->get('/{uuid}/metadata', [Saml2Controller::class, 'metadata'])
                            ->name('saml.metadata');

                        $router->post('/{uuid}/acs', [Saml2Controller::class, 'acs'])
                            ->name('saml.acs');

                        $router->get('/{uuid}/sls', [Saml2Controller::class, 'sls'])
                            ->name('saml.sls');
                    });

                // OAuth
                $router->post('oauth/token', [AccessTokenController::class, 'issueToken'])
                    ->middleware('throttle')
                    ->name('passport.token');

                $router->get('oauth/authorize', [AuthorizationController::class, 'authorize'])
                    ->middleware('web')
                    ->name('passport.authorizations.authorize');

                $router->prefix('oauth')
                    ->name('passport.')
                    ->middleware([
                        'web',
                        'auth:web',
                    ])
                    ->group(function (Router $router) {
                        $router->post('/token/refresh', [TransientTokenController::class, 'refresh'])
                            ->name('token.refresh');

                        $router->post('/authorize', [ApproveAuthorizationController::class, 'approve'])
                            ->name('authorizations.approve');

                        $router->delete('/authorize', [DenyAuthorizationController::class, 'deny'])
                            ->name('authorizations.deny');

                        $router->get('/tokens', [AuthorizedAccessTokenController::class, 'forUser'])
                            ->name('tokens.index');

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
