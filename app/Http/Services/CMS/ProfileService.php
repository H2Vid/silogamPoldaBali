<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Http\Requests\CMS\ProfileRequest;
use App\Models\User;
use App\Libraries\CMS;

class ProfileService extends BaseService
{
    public function handle(ProfileRequest $request)
    {
        $current_user = CMS::adminUser();
        $reformatted_email = reformatEmail($request->email);
        if (User::where('reformatted_email', $reformatted_email)->where('id', '<>', $current_user->id)->count() > 0) {
            return $this->error("Email is already used by another users", null, 400);
        }

        $current_user->email = $request->email;
        $current_user->reformatted_email = $reformatted_email;
        $current_user->name = $request->name;
        $current_user->image = $request->image;
        $current_user->save();

        return $this->success('Profile data has been updated', null);
    }
}