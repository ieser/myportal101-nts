<?php
return [
    'name' => 'Moulds',
    'need-authentication' => true,
    'layout' => 'reserved',
    'required-tables' => [
    ],
    'menu' => [
        'title' => 'Moulds',
        'icon' => 'fa-industry',
        'route' => '/moulds',
    ],
    'shortcuts' => [
        'global' => [
            [
                'label' => 'Lista stampi',
                'route' => '/moulds',
                'icon' => 'fa-industry',
            ],
        ],
        'entity' => [
            'User' => [
                'label' => 'Visualizza stampo',
                'route' => '/moulds/{id}',
                'icon' => 'fa-industry',
            ],
        ],
    ],
];

