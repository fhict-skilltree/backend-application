<?php

declare(strict_types=1);

namespace App\Courses\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

class CourseCollection extends ResourceCollection
{
    public $collects = CourseResource::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    #[OA\Schema(
        schema: 'CourseCollection',
        properties: [
            new OA\Property(
                property: 'data',
                ref: '#/components/schemas/CourseResource',
            ),
        ],
        type: 'object',
        allOf: [
            new OA\Property(ref: '#/components/schemas/PaginatorMeta'),
        ],
    )]
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
