<?php 

return [
    [
        'name' => 'botDb.sqlite',
        'tables' => [
            'users' => [
                'userId' => [
                    'type' => 'integer',
                    'default' => false,
                ],
                'is_bot' => [
                    'type' => 'integer',
                    'default' => 0,
                ],
                'firstName' => [
                    'type' => 'varchar(255)',
                    'default' => false,
                ],
                'lastName' => [
                    'type' => 'varchar(255)',
                    'default' => '',
                ],
                'username' => [
                    'type' => 'varchar(255)',
                    'default' => '',
                ],
                'language_code' => [
                    'type' => 'varchar(255)',
                    'default' => '',
                ],
            ],
            'chats' => [
                'chatId' => [
                    'type' => 'integer',
                    'default' => false,
                ],
                'type' => [
                    'type' => 'varchar(10)',
                    'default' => false,
                ],
                'title' => [
                    'type' => 'varchar(255)',
                    'default' => '',
                ],
                'username' => [
                    'type' => 'varchar(255)',
                    'default' => '',
                ],
            ],
            'lastLink' => [
                'link' => [
                    'type' => 'varchar(255)',
                    'default' => '',
                ],
            ],
        ],
    ],
];