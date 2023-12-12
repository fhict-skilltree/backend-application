<?php

declare(strict_types=1);

namespace App\Courses\Http\Controllers;

use App\Courses\Http\Resources\CourseResource;
use Domain\Users\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class UserEnrolledCoursesController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(User $user, Gate $gate)
    {
        $gate->authorize('view', $user);

        $courses = QueryBuilder::for($user->enrolledCourses())
            ->allowedSorts([
                'created_at',
            ])
            ->jsonPaginate();

        return CourseResource::collection($courses);
    }
}
