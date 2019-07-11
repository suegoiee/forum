<?php

namespace App\Policies;

use App\User;
use App\Models\Category;

class UserPolicy
{
    const ADMIN = 'admin';
    const BAN = 'ban';
    const DELETE = 'delete';
    const MASTER = 'master';

    /**
     * Determine if the current logged in user can see the admin section.
     */
    public function admin(User $user): bool
    {
        return $user->isAdmin();
    }

    public function master(User $user, int $tag)
    {
        return $user->isMasteredBy($tag);
    }

    /**
     * Determine if the current logged in user can ban a user.
     */
    public function ban(User $user, User $subject): bool
    {
        return ($user->isAdmin() && ! $subject->isAdmin()) ||
            ($user->isModerator() && ! $subject->isAdmin() && ! $subject->isModerator());
    }

    /**
     * Determine if the current logged in user can delete a user.
     */
    public function delete(User $user, User $subject): bool
    {
        return $user->isAdmin() && ! $subject->isAdmin();
    }

    public function isAuthoredBy(User $user): bool
    {
        return $this->author()->matches($user);
    }
}
