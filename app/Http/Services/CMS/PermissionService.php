<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Http\Requests\CMS\PermissionRequest;
use App\Models\Role;
use App\Libraries\CMS;

class PermissionService extends BaseService
{
    public function handle(PermissionRequest $request)
    {
        if ($request->id) {
            $role = Role::findOrFail($request->id);
            $msg = 'Permission role has been updated';
        } else {
            $role = new Role;
            $msg = 'Permission role has been created';
        }

        $role->name = $request->name;
        $role->role_owner = $request->role_owner;
        $role->save();

        removeCache('role');

        return $this->success($msg, route('cms.permission'));
    }
}