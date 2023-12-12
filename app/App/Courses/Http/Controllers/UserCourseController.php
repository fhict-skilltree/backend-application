<?php

declare(strict_types=1);

namespace App\Courses\Http\Controllers;

use App\Courses\Http\Resources\CourseResource;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class UserCourseController extends Controller
{
    public function index(Request $request, User $user)
    {
        $courses = QueryBuilder::for($user->enrolledCourses())
            ->allowedSorts([
                'created_at',
            ])
            ->jsonPaginate();

        //        // Get courses from organization
        //        // whereHas('organisatin')
        //        // Get courses that a student is enrolled to
        //        // where
        //
        //        $courses = Course::whereHas('users', fn ($courses) => $courses->whereIn('id', [$request->user()->id]))->get();

        return CourseResource::collection($courses);
    }

    public function showSkilltree()
    {
        return response()->json([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Semester 2',
                    'parent_skill_id' => null,
                ],
                [
                    'id' => 2,
                    'title' => 'Software Programming',
                    'parent_skill_id' => 1,
                ],
                [
                    'id' => 3,
                    'title' => 'Html Word',
                    'parent_skill_id' => 1,
                ],
                [
                    'id' => 4,
                    'title' => 'Flex Word',
                    'parent_skill_id' => 2,
                ],
                [
                    'id' => 5,
                    'title' => 'Spacious Word',
                    'parent_skill_id' => 2,
                ],
                [
                    'id' => 6,
                    'title' => 'Another Word',
                    'parent_skill_id' => 4,
                ],
                [
                    'id' => 7,
                    'title' => 'CSS Word',
                    'parent_skill_id' => 4,
                ],
                [
                    'id' => 8,
                    'title' => 'PHP Word',
                    'parent_skill_id' => 5,
                ],
                [
                    'id' => 9,
                    'title' => 'Node Word',
                    'parent_skill_id' => 5,
                ],
                [
                    'id' => 10,
                    'title' => 'Hello Word',
                    'parent_skill_id' => 5,
                ],
                [
                    'id' => 11,
                    'title' => 'Sans Word',
                    'parent_skill_id' => 5,
                ],
                [
                    'id' => 12,
                    'title' => 'JSX Word',
                    'parent_skill_id' => 10,
                ],
                [
                    'id' => 13,
                    'title' => 'Vue Word',
                    'parent_skill_id' => 9,
                ],

                //                [
                //                    'id' => 20,
                //                    'title' => 'Semester 4',
                //                    'parent_skill_id' => null,
                //                ],
                //                [
                //                    'id' => 21,
                //                    'title' => 'Java',
                //                    'parent_skill_id' => 20,
                //                ],
                //                [
                //                    'id' => 22,
                //                    'title' => 'Java',
                //                    'parent_skill_id' => 20,
                //                ],
            ],
        ]);
    }
}
