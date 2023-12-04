<?php

declare(strict_types=1);

use Domain\Organisation\Models\Organisation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authentication_methods', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active');
            $table->string('type');
            $table->foreignIdFor(Organisation::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authentication_methods');
    }
};
