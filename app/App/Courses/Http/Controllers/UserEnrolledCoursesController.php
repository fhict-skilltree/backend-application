<?php

declare(strict_types=1);

namespace App\Courses\Http\Controllers;

use App\Courses\Http\Resources\CourseCollection;
use Domain\Users\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;
use Spatie\QueryBuilder\QueryBuilder;

class UserEnrolledCoursesController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    #[OA\Get(
        path: '/users/{userUuid}/enrolled_courses ',
        summary: 'Get the enrolled courses of a user',
        security: [
            [
                'LocalhostOAuth' => [],
            ],
        ],
        tags: ['User']
    )]
    #[OA\Parameter(
        name: 'userUuid',
        description: 'The UUID of the user',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'string', format: 'uuid'),
    )]
    #[OA\Parameter(
        name: 'page[number]',
        description: 'The page number (default: 1)',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'string'),
    )]
    #[OA\Parameter(
        name: 'page[size]',
        description: 'The page number (default: 30, max: 30)',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'string'),
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/CourseCollection'),
    )]
    #[OA\Response(ref: '#/components/responses/401', response: 401)]
    #[OA\Response(ref: '#/components/responses/403', response: 403)]
    public function index(User $user, Gate $gate)
    {
        $gate->authorize('view', $user);

        $courses = QueryBuilder::for($user->enrolledCourses())
            ->allowedSorts([
                'created_at',
            ])
            ->jsonPaginate();

        return new CourseCollection($courses);
    }
}
