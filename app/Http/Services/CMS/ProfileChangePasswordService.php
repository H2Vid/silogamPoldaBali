<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Http\Requests\CMS\ProfileChangePasswordRequest;
use App\Models\User;
use App\Libraries\CMS;

class ProfileChangePasswordService extends BaseService
{
    public function handle(ProfileChangePasswordRequest $request)
    {
        $current_user = CMS::adminUser();
        if (!password_verify($request->old_password, $current_user->password)) {
            return $this->error("Invalid old password. Please retry with the correct password", 400, null);
        }

        $current_user->password = bcrypt($request->new_password);
        $current_user->save();

        return $this->success('Password has been updated', route('cms.change-password'));
    }
}