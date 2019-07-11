<?php

namespace App\Helpers;

use App\User;
use App\Models\Permission;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasPermissions
{
    /**
     * @return \App\Models\Permission[]
     */
    public function Permission()
    {
        return $this->permissionRelation;
    }

    /**
     * @param \App\Models\Permission[]|int[] $permissions
     */
    public function syncPermissions(int $permissions)
    {
        $this->save();
        $this->permissionRelation()->sync($permissions);
    }

    public function removePermission()
    {
        $this->permissionRelation()->detach();
    }

    public function permissionRelation(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    /**
     * @return \App\Models\Category[]
     */
    public function Category()
    {
        return $this->categoryRelation;
    }

    /**
     * @return \App\Models\Category[]
     */
    public function categoryRelation(): BelongsTo
    {
        return $this->BelongsTo(Category::class, 'id');
    }

    public function isMaster(Permission $permission): bool
    {
        return $this->Permission()->matches($permission);
    }

}
