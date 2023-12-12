<?php

declare(strict_types=1);

namespace Domain\Courses\Models\Factories;

use Domain\Courses\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Course>
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'content' => $this->faker->text,
        ];
    }
}
