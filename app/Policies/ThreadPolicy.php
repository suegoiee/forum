<?php

namespace App\Policies;

use App\User;
use App\Models\Thread;
use App\Models\Permission;

class ThreadPolicy
{
    const UPDATE = 'update';
    const DELETE = 'delete';
    const SUBSCRIBE = 'subscribe';
    const UNSUBSCRIBE = 'unsubscribe';
    const BAN = 'ban';

    public function ban(Permission $permission): bool
    {
        return $permission->isMaster();
    }

    public function update(User $user, Thread $thread): bool
    {
        return $thread->isAuthoredBy($user) || $user->isModerator() || $user->isAdmin();
    }

    public function delete(User $user, Thread $thread): bool
    {
        return $thread->isAuthoredBy($user) || $user->isModerator() || $user->isAdmin();
    }

    public function subscribe(User $user, Thread $thread): bool
    {
        return ! $thread->hasSubscriber($user) && $thread->isAuthoredBy($user);
    }

    public function unsubscribe(User $user, Thread $thread): bool
    {
        return $thread->hasSubscriber($user) && $thread->isAuthoredBy($user);
    }
}
