<?php

declare(strict_types=1);

namespace Domain\Courses\Models;

use Domain\Courses\Models\Factories\CourseFactory;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function uniqueIds()
    {
        return ['uuid'];
    }

    protected static function newFactory(): CourseFactory
    {
        return CourseFactory::new();
    }

    public function enrolledUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user_enrollments')
            ->withTimestamps();
    }
}
