<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Services\CMS\SettingService;
use Auth;
use Setting;

class SettingController extends Controller
{
    public function setting()
    {
        $setting = Setting::data();
        return view('cms.pages.setting.index', [
            'title' => 'Setting',
            'setting' => $setting,
        ]);
    }

    public function doSetting(SettingService $service)
    {
        return $this->handleService($this->request, $service);
    }
}