<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function manageUser(User $user, User $otherUser)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return $user->id === $otherUser->id;
    }
}
