<?php

declare(strict_types=1);

namespace Feature\App\Courses\Http\Controllers;

use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserEnrolledCoursesControllerTest extends TestCase
{
    use RefreshDatabase;

    private UrlGenerator $urlGenerator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->urlGenerator = $this->app->get(UrlGenerator::class);
    }

    public function test_it_can_list_the_enrolled_courses_of_a_user(): void
    {
        // Given
        $user = User::factory()->create();
        $courses = Course::factory(2)->create();
        $user->enrolledCourses()->sync($courses->pluck('id'));

        $firstCourse = $courses->get(0);
        $secondCourse = $courses->get(1);

        $endpoint = $this->urlGenerator->route('api.v1.users.show.enrolled_courses.index', [
            'user' => $user,
        ]);

        // When
        $response = $this
            ->actingAs($user, 'api')
            ->getJson($endpoint);

        // Then
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'uuid' => $firstCourse->uuid,
                    'title' => $firstCourse->title,
                    'content' => $firstCourse->content,
                    'created_at' => $firstCourse->created_at->toISOString(),
                    'updated_at' => $firstCourse->updated_at->toISOString(),
                ],
                [
                    'uuid' => $secondCourse->uuid,
                    'title' => $secondCourse->title,
                    'content' => $secondCourse->content,
                    'created_at' => $secondCourse->created_at->toISOString(),
                    'updated_at' => $secondCourse->updated_at->toISOString(),
                ],
            ],
        ]);
    }

    public function test_it_returns_unauthorized_response_when_user_is_not_authenticated(): void
    {
        // Given
        $user = User::factory()->create();

        $endpoint = $this->urlGenerator->route('api.v1.users.show.enrolled_courses.index', [
            'user' => $user,
        ]);

        // When
        $response = $this->getJson($endpoint);

        // Then
        $response->assertUnauthorized();
    }

    public function test_it_returns_forbidden_response_when_user_is_not_allowed_to_view_the_user(): void
    {
        // Given
        $user = User::factory()->create();
        $userToView = User::factory()->create();

        $endpoint = $this->urlGenerator->route('api.v1.users.show.enrolled_courses.index', [
            'user' => $userToView,
        ]);

        // When
        $response = $this
            ->actingAs($user, 'api')
            ->getJson($endpoint);

        // Then
        $response->assertForbidden();
    }
}
