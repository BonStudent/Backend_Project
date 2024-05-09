<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => [
        'api/*',
        'sanctum/csrf-cookie', 
        '/get_details/', 
        '/add_details/', 
        '/update_details/*',
        '/get_accounts/', 
        '/add_accounts/', 
        '/update_accounts/*', 
        '/get_remarks/', 
        '/add_remarks/', 
        '/update_remarks/*',
        '/get_recommendation/', 
        '/add_recommendation/', 
        '/update_recommendation/*',
        '/get_mtsrstatus/', 
        '/add_mtsrstatus/', 
        '/update_mtsrstatus/*',
        '/get_files/', 
        '/add_uploads/',
        // '/add_multiple_uploads/',
        // '/update_uploads/*',
        
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
