<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Http\Requests\CMS\AuthLoginRequest;
use App\Models\User;
use App\Libraries\CMS;

class AuthLoginService extends BaseService
{
    public function handle(AuthLoginRequest $request)
    {
        $reformatted_email = reformatEmail($request->email);
        $user = User::where('email', $request->email)->orWhere('reformatted_email', $reformatted_email)->first();
        if (!$user) {
            return $this->error('We cannot find the user with that credential', null, 400);
        }
        $user = CMS::adminGuard()->attempt([
            'reformatted_email' => $reformatted_email,
            'password' => $request->password,
        ], $request->has('remember'));
        if (!$user) {
            return $this->error("We cannot verify your credential. Please retry again", null, 400);
        }

        return $this->success('You have logged in successfully', adminURL(''));
    }
}