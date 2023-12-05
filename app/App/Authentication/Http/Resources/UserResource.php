<?php

declare(strict_types=1);

namespace App\Authentication\Http\Resources;

use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    #[OA\Schema(
        schema: 'UserResource',
        properties: [
            new OA\Property(
                property: 'id',
                description: 'The id of the user',
                type: 'integer'
            ),
            new OA\Property(
                property: 'first_name',
                description: 'The first name of the user',
                type: 'string'
            ),
            new OA\Property(
                property: 'last_name',
                description: 'The last name of the user',
                type: 'string'
            ),
            new OA\Property(
                property: 'email',
                description: 'The email of the user',
                type: 'string',
            ),
            new OA\Property(
                property: 'created_at',
                description: 'The date the user is created',
                type: 'string',
                format: 'date-time',
            ),
            new OA\Property(
                property: 'updated_at',
                description: 'The date the user is updated',
                type: 'string',
                format: 'date-time',
            ),
        ],
        type: 'object',
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
