<?php

declare(strict_types=1);

namespace Domain\Organisations\Models;

use Domain\Organisations\Models\Factories\OrganisationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
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
    ];

    public function authenticationMethods(): HasMany
    {
        return $this->hasMany(AuthenticationMethod::class);
    }

    protected static function newFactory(): OrganisationFactory
    {
        return OrganisationFactory::new();
    }
}
