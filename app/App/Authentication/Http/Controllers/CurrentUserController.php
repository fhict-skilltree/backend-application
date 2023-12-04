<?php

declare(strict_types=1);

namespace App\Authentication\Http\Controllers;

use App\Authentication\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CurrentUserController extends Controller
{
    public function show(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
