<?php

declare(strict_types=1);

namespace App\Skilltrees\Http\Controllers;

use Illuminate\Routing\Controller;

class SkilltreeController extends Controller
{
    public function index()
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
