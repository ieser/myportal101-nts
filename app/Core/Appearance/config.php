<?php
return [
    'name' => 'Appereance',
    'version' => '1.0',
    'description' => 'Handle to manage user preferences',
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
        ],
        'users_preferences' => [
            'columns' => [
                'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'user_id' => 'INT(11)',
                'theme' => 'VARCHAR(200) NOT NULL',
                'language' => 'VARCHAR(2) NOT NULL'
            ],
        ]
    ],
];

