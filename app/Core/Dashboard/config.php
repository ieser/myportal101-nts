<?php
return [
    'name' => 'Dashboard',
    'need-authentication' => true,
    'layout' => 'reserved',
    'required-tables' => [
        'dashboard' => [
            'columns' => [
            ],
        ]
    ],
    'menu' => [
        'title' => 'Dashboard',
        'icon' => 'fa-home',
        'route' => '/dashboard',
    ],
    'shortcuts' => [
        'global' => [
            [
                'label' => 'Dashboard',
                'route' => '/dashboard',
                'icon' => 'fa-home',
            ],
        ]
    ],
];

