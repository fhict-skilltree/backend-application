<?php

declare(strict_types=1);

namespace App\Authentication\Http\Controllers;

use App\Authentication\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;

class CurrentUserController extends Controller
{
    #[OA\Get(
        path: '/auth/current-user',
        summary: 'Get current authenticated user',
        tags: ['User'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/UserResource'),
    )]
    #[OA\Response(ref: '#/components/responses/401', response: 401)]
    #[OA\Response(ref: '#/components/responses/403', response: 403)]
    public function show(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
