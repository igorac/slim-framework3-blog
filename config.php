<?php


return [
    'email' => [
        'host' => 'smtp.mailtrap.io',
        'port' => 465,
        'username' => '5072c0e73ad1a4',
        'password' => 'bd3c195865ac69'
    ], 
    'login' => [
        'admin' => [
            'loggedIn' => 'admin_login',
            'redirect' => '/admin',
            'idLoggedIn' => 'id_admin',
        ],
        'user' => [
            'loggedIn' => 'user_login',
            'redirect' => '/',
            'idLoggedIn' => 'id_user',
        ]
    ]
]; 