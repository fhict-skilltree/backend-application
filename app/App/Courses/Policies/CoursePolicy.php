<?php

declare(strict_types=1);

namespace App\Courses\Policies;

use Domain\Courses\Models\Course;
use Domain\Users\Models\User;

class CoursePolicy
{
    public function view(User $user, Course $course): bool
    {
        if ($user->enrolledCourses()->where('id', '=', $course->id)->exists()) {
            return true;
        }

        return true;
    }
}
