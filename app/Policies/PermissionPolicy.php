<?php

namespace App\Policies;

use App\User;
use App\Models\Permission;

class PermissionPolicy
{
    const UPDATE = 'update';

    public function update(User $user, Permission $permission): bool
    {
        return $user->isAdmin();
    }
}
