<?php

declare(strict_types=1);

namespace Domain\Organisation\Models;

use Domain\Organisation\Enums\AuthenticationMethodType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthenticationMethod extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'type' => AuthenticationMethodType::class,
        'is_active' => 'boolean',
    ];
}
