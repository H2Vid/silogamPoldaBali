<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\ProfileRequest;
use App\Http\Requests\CMS\ProfileChangePasswordRequest; 
use App\Http\Services\CMS\ProfileService;
use App\Http\Services\CMS\ProfileChangePasswordService;
use Auth;
use CMS;

class ProfileController extends Controller
{
    public function index()
    {
        return view('cms.pages.profile.index', [
            'title' => 'Manage Profile',
            'user' => CMS::adminUser(),
        ]);
    }

    public function store(ProfileRequest $request, ProfileService $service)
    {
        return $this->handleService($request, $service);
    }

    public function changePassword()
    {
        return view('cms.pages.profile.change-password', [
            'title' => 'Change Password',
            'user' => CMS::adminUser(),
        ]);
    }

    public function doChangePassword(ProfileChangePasswordRequest $request, ProfileChangePasswordService $service)
    {
        return $this->handleService($request, $service);
    }
}