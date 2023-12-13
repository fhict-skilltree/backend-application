<?php

declare(strict_types=1);

namespace App\Courses\Http\Controllers;

use App\Courses\Http\Resources\CourseResource;
use Domain\Courses\Models\Course;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;

class ShowController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    #[OA\Get(
        path: '/courses/{courseUuid} ',
        summary: 'Get the course details',
        security: [
            [
                'LocalhostOAuth' => [],
            ],
        ],
        tags: ['Courses']
    )]
    #[OA\Parameter(
        name: 'courseUuid',
        description: 'The UUID of the course',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'string', format: 'uuid'),
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/CourseResource'),
    )]
    #[OA\Response(ref: '#/components/responses/401', response: 401)]
    #[OA\Response(ref: '#/components/responses/403', response: 403)]
    public function __invoke(Request $request, Course $course, Gate $gate): CourseResource
    {
        $gate->authorize('view', $course);

        return new CourseResource($course);
    }
}
