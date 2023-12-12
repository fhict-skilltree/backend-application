<?php

declare(strict_types=1);

use App\Courses\Http\Controllers\ShowController as CourseShowController;
use App\Courses\Http\Controllers\UserCourseController;
use Illuminate\Routing\Router;

/** @var Router $router */

// Protected
$router->middleware('auth:api')
    ->group(function (Router $router) {
        //
        // Users
        //
        $router->prefix('users')->group(function (Router $router) {
            //
            // Courses
            //
            $router->get('/{user:uuid}/courses', [UserCourseController::class, 'index']);
        });

        //
        // Courses
        //
        $router->prefix('courses')->group(function (Router $router) {
            $router->get('/{course:uuid}', CourseShowController::class);
        });

        $router->get('/skilltrees/1', [UserCourseController::class, 'showSkilltree']);
    });
