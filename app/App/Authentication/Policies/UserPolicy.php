<?php

declare(strict_types=1);

namespace App\Authentication\Policies;

use Domain\Users\Models\User;

class UserPolicy
{
    public function view(User $authenticatedUser, User $user): bool
    {
        return $authenticatedUser->id === $user->id;
    }
}
