<?php

namespace App\Jobs;

use App\Models\Permission;
use App\Http\Requests\PermissionRequest;

final class UpdatePermission
{
    public function __construct(array $user_id, array $category_id)
    {
        $this->user_id = $user_id;
        $this->category_id = $category_id;
    }

    public static function fromRequest(PermissionRequest $request): self
    {
        return new static(
            $request->user_id(),
            $request->category_id()
        );
    }

    public function handle(): Permission
    {
        //$this->permission->update($this->attributes);
        $permissions = array();
        $uid = $this->user_id;
        $cid = $this->category_id;
        for($i = 0; $i < count($uid); $i++){
            $permissions[$i] = Permission::firstOrCreate([
                'user_id' => $uid[$i],
                'permission' => 5,
                'category_id' => $cid[$i],
            ]);
            $permissions[$i]->save();
        }
        return $permissions[0];
    }
}
