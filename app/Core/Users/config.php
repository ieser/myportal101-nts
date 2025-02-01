<?php
return [
    'name' => 'Users',
    'description' => 'Handle to manage user details',
    'need-authentication' => true,
    'layout' => 'reserved',
    'required-tables' => [
        'users' => [
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
        'title' => 'Utenti',
        'icon' => 'fa-users',
        'route' => '/users',
    ],
    'shortcuts' => [
        'global' => [
            [
                'label' => 'Aggiungi Utente',
                'route' => '/users/create',
                'icon' => 'fa-user-plus',
            ],
        ],
        'entity' => [
            'User' => [
                'label' => 'Modifica Utente',
                'route' => '/users/edit/{id}',
                'icon' => 'fa-edit',
            ],
        ],
    ],
];

