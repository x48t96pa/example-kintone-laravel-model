<?php

// TODO: 要らないので削除予定動作確認用
return [
    // TODO: database.phpに書くべきか？
    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [
        'kintone' => [
            // 'url' => env('KINTONE_URL', 'https://rt-group93.s.cybozu.com'),
            'host' => env('KINTONE_HOST', 'rt-group93.s.cybozu.com'), //env('KINTONE_HOST', ''),
            // 'port' => env('KINTONE_PORT', '443'),
            // 'username' => env('KINTONE_USERNAME', 'Administrator'),
            // 'password' => env('KINTONE_PASSWORD', ''),
            'cert_file' => env('KINTONE_CERT_FILE', ''),
            'cert_password' => env('KINTONE_CERT_PASSWORD', ''),
            'use_client_cert' => env('KINTONE_USE_CLIENT_CERT', false),
            // 'options' => extension_loaded('pdo_mysql') ? array_filter([
            //     PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            // ]) : [],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],
];
