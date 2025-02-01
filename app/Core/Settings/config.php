<?php
return [
    'name' => 'Settings',
    'need-authentication' => true,
    'layout' => 'reserved',
    'required-tables' => [
        'settings' => [
            'columns' => [
                'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'name' => 'VARCHAR(200) NOT NULL',
                'lastname' => 'VARCHAR(200) NOT NULL',
                'email' => 'VARCHAR(150) NOT NULL',
                'password' => 'VARCHAR(100) NOT NULL',
                'image' => 'VARCHAR(200)',
                'role' => 'VARCHAR(150)',
                'dateinsert' => 'DATE DEFAULT CURRENT_TIMESTAMP',
                'lastlogin' => 'DATETIME DEFAULT CURRENT_TIMESTAMP',
                'active' => 'INT(11)',
            ],
        ]
    ],
    'menu' => [
        'title' => 'Impostazioni',
        'icon' => 'fa-gear',
        'route' => '/settings',
    ],
    'shortcuts' => [
        'global' => [
            [
                'label' => 'Impostazioni',
                'route' => '/settings',
                'icon' => 'fa-gear',
            ],
        ],
    ],
];

