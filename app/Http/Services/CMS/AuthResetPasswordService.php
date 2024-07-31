<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Http\Requests\CMS\AuthResetPasswordRequest;
use App\Models\User;
use App\Libraries\CMS;
use DB;

class AuthResetPasswordService extends BaseService
{
    public function handle(AuthResetPasswordRequest $request)
    {
        $data = DB::table('password_resets')->where('token', $request->token)->first();
        if (empty($data)) {
            abort(404);
        }        

        $user = User::where('reformatted_email', $data->email)->firstOrFail();

        if (CMS::adminIsLoggedIn()) {
            CMS::adminGuard()->logout();
        }
        
        $user->password = bcrypt($request->password);
        $user->save();

        // auto login
        CMS::adminGuard()->login($user);

        DB::table('password_resets')->where('token', $request->token)->delete();

        return $this->success('Your password has been changed successfully', adminURL(''));
    }
}