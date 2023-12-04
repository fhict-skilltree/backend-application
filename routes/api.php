<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Routing\Router;


/** @var \Illuminate\Routing\Router $router */
$router->middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication namespace
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
            });

    });

