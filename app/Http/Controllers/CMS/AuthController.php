<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\CMS\AuthLoginRequest;
use App\Http\Services\CMS\AuthLoginService;
use App\Http\Requests\CMS\AuthRegisterRequest;
use App\Http\Services\CMS\AuthRegisterService;
use App\Http\Requests\CMS\AuthForgotPasswordRequest;
use App\Http\Services\CMS\AuthForgotPasswordService;
use App\Http\Requests\CMS\AuthResetPasswordRequest;
use App\Http\Services\CMS\AuthResetPasswordService;
use App\Libraries\CMS;
use DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('cms.pages.auth.login', [
            'title' => 'Log In'
        ]);
    }

    public function doLogin(AuthLoginRequest $request, AuthLoginService $service)
    {
        return $this->handleService($request, $service);
    }

    public function doForgotPassword(AuthForgotPasswordRequest $request, AuthForgotPasswordService $service)
    {
        return $this->handleService($request, $service);
    }

    public function resetPassword()
    {
        $token = $this->request->token;
        $data = DB::table('password_resets')->where('token', $token)->first();
        if (empty($data)) {
            abort(404);
        }        

        $user = User::where('reformatted_email', $data->email)->firstOrFail();

        return view('cms.pages.auth.reset-password', [
            'title' => 'Reset Password',
            'user' => $user,
            'token' => $token,
        ]);
    }
    
    public function doResetPassword(AuthResetPasswordRequest $request, AuthResetPasswordService $service)
    {
        return $this->handleService($request, $service);
    }
    

    public function register()
    {
        // if register feature disabled : Page Not Found
        if (!config('cms.feature.auth.enable_registration')) {
            abort(404);
        }
        return view('cms.pages.auth.register', [
            'title' => 'Register'
        ]);
    }

    public function doRegister(AuthRegisterRequest $request, AuthRegisterService $service) 
    {
        return $this->handleService($request, $service);
    }

    public function logout()
    {
        CMS::adminGuard()->logout();
        return redirect()->route('cms.auth.login')->with([
            'success' => 'You have been logged out successfully'
        ]);
    }
}