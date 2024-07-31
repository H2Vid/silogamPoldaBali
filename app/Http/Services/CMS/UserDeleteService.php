<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseDeleteService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use CMS;
use Exception;

class UserDeleteService extends BaseDeleteService
{
    public function model()
    {
        return User::query();
    }

    public function verifyBeforeDelete($dataToBeDeleted)
    {
        $sa = Role::where('is_sa', 1)->first();
        $another_sa_user = User::whereHas('roles', function($qry) use($sa){
            $qry->where('roles.id', $sa->id);
        })->whereNotIn('users.id', $dataToBeDeleted->pluck('id'))->count();

        if ($another_sa_user == 0) {
            return 'Cannot delete user, no superadmin left if current transaction continued';
        }

        return null;
    }

    public function afterDelete($deleted_ids=[]) 
    {
        // 
    }

}