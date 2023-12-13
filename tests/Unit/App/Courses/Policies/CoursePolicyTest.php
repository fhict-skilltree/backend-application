<?php

declare(strict_types=1);

namespace Tests\Unit\App\Courses\Policies;

use App\Courses\Policies\CoursePolicy;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class CoursePolicyTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_a_user_that_has_enrolled_the_course_can_view_it(): void
    {
        // Given
        $user = Mockery::mock(User::class);
        $course = Mockery::mock(Course::class);

        $course->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(202)
            ->once();

        $userEnrolledCoursesRelations = Mockery::mock(BelongsToMany::class);
        $user->shouldReceive('enrolledCourses')
            ->andReturn($userEnrolledCoursesRelations)
            ->once();
        $userEnrolledCoursesRelations->shouldReceive('where')
            ->with('id', '=', 202)
            ->andReturnSelf()
            ->once();
        $userEnrolledCoursesRelations->shouldReceive('exists')
            ->andReturnTrue()
            ->once();

        $policy = new CoursePolicy();

        // When
        $result = $policy->view($user, $course);

        // Then
        self::assertTrue($result);
    }

    public function test_a_user_that_has_not_enrolled_the_course_cannot_view_it(): void
    {
        // Given
        $user = Mockery::mock(User::class);
        $course = Mockery::mock(Course::class);

        $course->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(202)
            ->once();

        $userEnrolledCoursesRelations = Mockery::mock(BelongsToMany::class);
        $user->shouldReceive('enrolledCourses')
            ->andReturn($userEnrolledCoursesRelations)
            ->once();
        $userEnrolledCoursesRelations->shouldReceive('where')
            ->with('id', '=', 202)
            ->andReturnSelf()
            ->once();
        $userEnrolledCoursesRelations->shouldReceive('exists')
            ->andReturnFalse()
            ->once();

        $policy = new CoursePolicy();

        // When
        $result = $policy->view($user, $course);

        // Then
        self::assertFalse($result);
    }
}
