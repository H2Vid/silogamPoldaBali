<?php
namespace App\Extenders;

use App\Components\Setting\SettingItem;
use App\Components\Setting\SettingRegistration;

class SettingGenerator extends SettingRegistration
{
    public function handle()
    {
        $this->addSettingGroup('general', [
            new SettingItem('title', 'Site Title', 'text', [
                'placeholder' => "Your Site Title",
                'required' => 'required',
            ]),
            new SettingItem('description', 'Site Description', 'textarea'),
            new SettingItem('favicon', 'Site Favicon', 'image', [
                'accept' => 'image/*',
            ]),
            new SettingItem('logo_wide', 'Site Wide Logo', 'image', [
                'accept' => 'image/*',
            ]),
            new SettingItem('logo', 'Site Square Logo', 'image', [
                'accept' => 'image/*',
            ]),
            new SettingItem('login_background', 'Login Background', 'image', [
                'accept' => 'image/*',
            ]),

            new SettingItem('ask_delete', 'Ask Confirmation Before Delete', 'yesno'),

            new SettingItem('phone', 'Site Phone Number', 'tel'),
            new SettingItem('email', 'Site Email', 'email'),
            new SettingItem('address', 'Site Address', 'textarea'),
        ], 1);

        $this->addSettingGroup('seo', [
            new SettingItem('title', 'Default SEO Title'),
            new SettingItem('description', 'Default SEO Description', 'textarea'),
            new SettingItem('image', 'Default SEO Image', 'image', [
                'accept' => 'image/*',
            ]),
        ], 2);

    }

}
