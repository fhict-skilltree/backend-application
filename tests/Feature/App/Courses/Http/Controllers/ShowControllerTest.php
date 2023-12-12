<?php

declare(strict_types=1);

namespace Tests\Feature\App\Courses\Http\Controllers;

use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;

    private UrlGenerator $urlGenerator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->urlGenerator = $this->app->get(UrlGenerator::class);
    }

    public function test_it_can_return_the_course_resource(): void
    {
        // Given
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $user->enrolledCourses()->sync([$course->id]);

        $endpoint = $this->urlGenerator->route('api.v1.courses.show', [
            'course' => $course,
        ]);

        // When
        $response = $this
            ->actingAs($user, 'api')
            ->getJson($endpoint);

        // Then
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'uuid' => $course->uuid,
                'title' => $course->title,
                'content' => $course->content,
                'created_at' => $course->created_at->toISOString(),
                'updated_at' => $course->updated_at->toISOString(),
            ],
        ]);
    }

    public function test_it_returns_unauthorized_response_when_user_is_not_authenticated(): void
    {
        // Given
        $course = Course::factory()->create();

        $endpoint = $this->urlGenerator->route('api.v1.courses.show', [
            'course' => $course,
        ]);

        // When
        $response = $this->getJson($endpoint);

        // Then
        $response->assertUnauthorized();
    }

    public function test_it_returns_unauthorized_response_when_user_is_not_enrolled_to_course(): void
    {
        // Given
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $endpoint = $this->urlGenerator->route('api.v1.courses.show', [
            'course' => $course,
        ]);

        // When
        $response = $this
            ->actingAs($user, 'api')
            ->getJson($endpoint);

        // Then
        $response->assertForbidden();
    }
}
