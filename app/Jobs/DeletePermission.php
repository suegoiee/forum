<?php

namespace App\Jobs;

use DB;
use App\Models\Permission;
use App\Http\Requests\DeletePermissionRequest;

final class DeletePermission
{
    private $permission;
    private $DeleteId;

    public function __construct(Permission $permission, array $DeleteId = [])
    {
        $this->permission = $permission;
        $this->DeleteId = array_only($DeleteId, ['id']);
    }

    public static function fromRequest(Permission $permission, DeletePermissionRequest $request): self
    {
        return new static($permission, [
            'id' => $request->id()
        ]);
    }

    public function handle()
    {
        DB::table('permission')->where('id', '=', $this->DeleteId)->delete();
    }
}
