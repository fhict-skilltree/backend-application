<?php

declare(strict_types=1);

namespace App\Shared\Providers;

use App\Courses\Policies\CoursePolicy;
use Domain\Courses\Models\Course;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];

    public function boot(): void
    {
    }
}
