<?php

declare(strict_types=1);

namespace App\Courses\Http\Resources;

use Domain\Courses\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin Course
 */
class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    #[OA\Schema(
        schema: 'CourseResource',
        properties: [
            new OA\Property(
                property: 'uuid',
                description: 'The uuid of the course',
                type: 'string'
            ),
            new OA\Property(
                property: 'title',
                description: 'The title the user',
                type: 'string'
            ),
            new OA\Property(
                property: 'excerpt',
                description: 'The excerpt of the course',
                type: 'string'
            ),
            new OA\Property(
                property: 'content',
                description: 'The content of the course',
                type: 'string'
            ),
            new OA\Property(
                property: 'created_at',
                description: 'The date the course is created',
                type: 'string',
                format: 'date-time',
            ),
            new OA\Property(
                property: 'updated_at',
                description: 'The date the course is updated',
                type: 'string',
                format: 'date-time',
            ),
        ],
        type: 'object',
    )]
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
