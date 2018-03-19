<?php

return [

    'displayErrorDetails' => true,
    'cache' => false,


    'db' => [
        'host' => 'localhost',
        'driver' => 'mysql',
        'database' => 'forum',
        'username' => 'root',
        'password' => 'hejhej123',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci'
    ],

    'session' => [
        'name' => 'forum'
    ],

    'theme' => [
        'file' => INSTALL_PATH . '/config/theme.php'
    ],

    'view' => [
        'directory' => INSTALL_PATH . '/res/views',
        'prefix' => 'phtml'
    ]

];
