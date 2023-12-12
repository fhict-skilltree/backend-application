<?php

declare(strict_types=1);

namespace Domain\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Domain\Courses\Models\Course;
use Domain\Users\Models\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'remote_reference',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'authentication_method_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function uniqueIds()
    {
        return ['uuid'];
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_user_enrollments')
            ->withTimestamps();
    }
}
