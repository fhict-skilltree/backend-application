<?php

declare(strict_types=1);

use App\Courses\Http\Controllers\ShowController as CourseShowController;
use App\Courses\Http\Controllers\UserEnrolledCoursesController;
use App\Skilltrees\Http\Controllers\SkilltreeController;
use Illuminate\Routing\Router;

/** @var Router $router */

// Protected
$router
    ->middleware('auth:api')
    ->name('api.v1.')
    ->group(function (Router $router) {
        //
        // Users
        //
        $router
            ->prefix('users')
            ->name('users.')
            ->group(function (Router $router) {
                //
                // Courses
                //
                $router->get('/{user:uuid}/enrolled_courses', [UserEnrolledCoursesController::class, 'index'])
                    ->name('show.enrolled_courses.index');
            });

        //
        // Courses
        //
        $router
            ->prefix('courses')
            ->name('courses.')
            ->group(function (Router $router) {
                $router->get('/{course:uuid}', CourseShowController::class)
                    ->name('show');
            });

        $router->get('/skilltrees/1', [SkilltreeController::class, 'index']);
    });
