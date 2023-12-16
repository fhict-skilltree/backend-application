<?php

declare(strict_types=1);

use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('title');
            $table->text('excerpt');
            $table->text('content')->nullable();
            $table->timestamps();
        });

        Schema::create('course_user_enrollments', function (Blueprint $table) {
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Course::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_user_enrollments');
    }
};
