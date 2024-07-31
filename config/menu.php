<?php
return [
    'homepage' => [
        'sort' => 1,
        'title' => 'Homepage',
        'icon' => 'home',
        'route' => 'cms.index',
        'active_key' => ['homepage'],
    ],

    // 'example' => [
    //     'sort' => 5,
    //     'title' => 'Example Menu',
    //     'icon' => 'tool',
    //     'submenu' => [
    //         'sub_one' => [
    //             'sort' => 1,
    //             'title' => 'Sub Example Menu',
    //             'submenu' => [
    //                 'test' => [
    //                     'title' => 'Lorem Ipsum',
    //                     'url' => '#',
    //                     'sort' => 25,
    //                 ],
    //                 'test2' => [
    //                     'title' => 'Lorem Ipsum 2',
    //                     'sort' => 12,
    //                     'url' => 'https://tianrosandhy.com',
    //                     'new_tab' => true,
    //                 ],
    //             ]
    //         ],
    //         'sub_two' => [
    //             'sort' => 2,
    //             'title' => 'Sub Example Again',
    //         ],
    //     ]
    // ],


    'setting' => [
        'sort' => 999,
        'title' => 'Setting',
        'icon' => 'settings',
        'active_key' => ['setting', 'user', 'permission'],
        'submenu' => [
            'setting' => [
                'sort' => 1,
                'title' => 'Setting',
                'icon' => 'settings',
                'route' => 'cms.setting',
                'active_key' => ['setting'],        
            ],
            'user' => [
                'sort' => 99,
                'title' => 'All User Management',
                'icon' => 'user',
                'route' => 'cms.user.index',
                'active_key' => ['user'],
            ],
        
            'permission' => [
                'sort' => 199,
                'title' => 'Permission Management',
                'icon' => 'check-circle',
                'route' => 'cms.permission',
                'active_key' => ['permission'],
            ],

            'log' => [
                'sort' => 999,
                'title' => 'Log Preview',
                'route' => 'cms.log.index',
                'active_key' => 'log'
            ],
        
        ]
    ],


];