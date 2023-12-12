<?php

declare(strict_types=1);

namespace App\Courses\Http\Controllers;

use App\Courses\Http\Resources\CourseResource;
use Domain\Courses\Models\Course;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShowController extends Controller
{
    public function __invoke(Request $request, Course $course, Gate $gate): CourseResource
    {
        $gate->authorize('view', $course);

        return new CourseResource($course);
    }
}
