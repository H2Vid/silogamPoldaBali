<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Components\RoleStructure;
use App\Models\Role;
use App\Libraries\CMS;
use Illuminate\Http\Request;

class PermissionDeleteService extends BaseService
{
    public function handle(Request $request)
    {
        $id = $request->id;
        $structure = new RoleStructure;
        $available_role = $structure->array_only;
        if (!in_array($id, $available_role)) {
            return $this->error('Action forbidden', 403);
        }

        $role_will_be_deleted = app('role')->where('id', $id)->first();
        if (empty($role_will_be_deleted)) {
            return $this->error("Role data not found", 404);
        }
        if ($role_will_be_deleted->is_sa) {
            return $this->error('You cannot delete this superadmin role', 400);
        }

        //sebelum hapus, pastikan anak2nya tetap dalam kondisi terurus
        $anak2list = $role_will_be_deleted->children;
        $owner = $role_will_be_deleted->owner;

        if (!empty($owner)) {
            $update_owner_to = $owner->id;
        } else {
            $update_owner_to = null;
        }

        foreach ($anak2list as $anak) {
            $anak->role_owner = $update_owner_to;
            $anak->save();
        }

        $role_will_be_deleted->delete();
        removeCache('role');

        return $this->success('Privilege has been deleted successfully', route('cms.permission'));
    }
}