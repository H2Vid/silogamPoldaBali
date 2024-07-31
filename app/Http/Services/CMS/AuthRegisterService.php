<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Http\Requests\CMS\AuthRegisterRequest;
use App\Models\User;
use App\Libraries\CMS;

class AuthRegisterService extends BaseService
{
    public function handle(AuthRegisterRequest $request)
    {
        $reformatted_email = reformatEmail($request->email);
        if (User::where('reformatted_email', $reformatted_email)->count() > 0) {
            return $this->error("Email is already used by another users", null, 400);
        }

        $user = new User;
        $user->email = $request->email;
        $user->reformatted_email = $reformatted_email;
        $user->password = bcrypt($request->password);
        $user->name = $request->full_name;
        $user->activation_key = sha1(rand(1, 99999) . uniqid());
        $user->save();

        return $this->success('You have registered successfully. Admin will verify your account first', route('cms.auth.login'));
    }
}