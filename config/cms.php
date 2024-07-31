<?php
return [
    'admin_prefix' => env('ADMIN_PREFIX', 'cms'),
    'auth_guard_name' => 'cms',
    'lang' => [
        'available' => [
            'en' => 'English',
            'id' => 'Indonesian',    
        ],
        'default' => 'en',
    ],
    'feature' => [
        'auth' => [
            'enable_registration' => true,
            'enable_reset_password' => true,
            'enable_remember_me' => true,    
        ],
        'enable_notification' => false,
        'enable_language' => false,
        'enable_global_search' => false,
    ],

    'max_export_row_limit' => 10000,
    'max_filesize' => [
        'file' => 50,
        'image' => 20,
    ],

    'site_title' => 'CMS',
    'site_square_logo' => 'img/logo-square.png',
    'site_wide_logo' => 'img/logo-wide.png',
    'site_favicon' => 'img/logo-square.png',

    'cache_key' => [
        'role' => 'APP-CMS-ALLROLE',
        'setting' => 'APP-CMS-ALLSETTING',
    ],
];