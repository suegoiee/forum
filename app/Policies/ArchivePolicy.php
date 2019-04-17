<?php

namespace App\Policies;

use App\User;
use App\Models\Archive;

class ArchivePolicy
{

    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const SUBSCRIBE = 'subscribe';
    const UNSUBSCRIBE = 'unsubscribe';

    public function create(User $user): bool
    {
        return $user->isModerator() || $user->isAdmin();
    }

    public function update(User $user, Archive $archive): bool
    {
        return ($archive->isAuthoredBy($user) && $user->isModerator()) || $user->isAdmin();
    }

    public function delete(User $user, Archive $archive): bool
    {
        return ($archive->isAuthoredBy($user) && $user->isModerator()) || $user->isAdmin();
    }

    public function subscribe(User $user, Archive $archive): bool
    {
        return ! $archive->hasSubscriber($user) && $archive->isAuthoredBy($user);
    }

    public function unsubscribe(User $user, Archive $archive): bool
    {
        return $archive->hasSubscriber($user) && $archive->isAuthoredBy($user);
    }
}
