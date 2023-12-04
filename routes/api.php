<?php

declare(strict_types=1);

use App\Authentication\Http\Controllers\CurrentUserController;
use App\Authentication\Http\Controllers\RedirectToCourseController;
use Illuminate\Routing\Router;

/** @var Router $router */

// Authentication namespace
$router->prefix('auth')
    ->name('auth.')
    ->group(function (Router $router) {
        // Current user
        $router
            ->middleware('auth:sanctum')
            ->name('current-user')
            ->get('current-user', [CurrentUserController::class, 'show']);

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
            });

        // Redirect
        $router//->middleware('auth')
            ->get('/redirect-to-course', [RedirectToCourseController::class, 'process']);
    });
