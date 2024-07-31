<?php
namespace App\Http\Services\CMS;

use App\Base\Services\BaseService;
use App\Http\Requests\CMS\AuthForgotPasswordRequest;
use App\Models\User;
use App\Libraries\CMS;
use App\Jobs\CMS\SendResetPasswordMail;
use DB;
use Exception;

class AuthForgotPasswordService extends BaseService
{
    public function handle(AuthForgotPasswordRequest $request)
    {
        $reformatted_email = reformatEmail($request->email);
        $user = User::where('email', $request->email)->orWhere('reformatted_email', $reformatted_email)->first();
        if (empty($user)) {
            return $this->error('We cannot find the user with that credential', null, 400);
        }

        // 
        $token = sha1(rand(1, 99999) . uniqid() . $reformatted_email);
        $current = DB::table('password_resets')->where('email', $reformatted_email)->first();
        if (!empty($current)) {
            $last_timestamp = strtotime($current->created_at);
            if (time() - $last_timestamp < 180) {
                return $this->error('Please wait '.(180 - (time() - $last_timestamp)).' seconds before resend the password reset request again.', route('cms.auth.login'), 400);
            }
        }

        DB::table('password_resets')->where('email', $reformatted_email)->delete();
        DB::table('password_resets')->insert([
            'email' => $reformatted_email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        try {
            SendResetPasswordMail::dispatch($reformatted_email, $token);
        } catch (Exception $e) {
            return $this->error('Server Error. We cannot send the password reset email.', route('cms.auth.login'), 500);
        }

        return $this->success('We have sent the reset password link to your email.', route('cms.auth.login'));
    }
}