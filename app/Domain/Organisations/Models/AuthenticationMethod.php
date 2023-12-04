<?php

declare(strict_types=1);

namespace Domain\Organisations\Models;

use Domain\Organisations\Enums\AuthenticationMethodType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function samlTenant(): BelongsTo
    {
        return $this->belongsTo(SamlTenant::class);
    }
}
