<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Flutter web runs in the browser, so API calls are subject to CORS checks.
    | These local origins cover common dev hosts and ports used by Flutter.
    |
    */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        env('FRONTEND_URL', 'http://localhost'),
        'http://localhost',
        'http://localhost:3000',
        'http://localhost:5000',
        'http://localhost:5173',
        'http://localhost:8000',
        'http://127.0.0.1',
        'http://127.0.0.1:3000',
        'http://127.0.0.1:5000',
        'http://127.0.0.1:5173',
        'http://127.0.0.1:8000',
    ],

    'allowed_origins_patterns' => [
        '#^http://localhost(:\d+)?$#',
        '#^http://127\.0\.0\.1(:\d+)?$#',
    ],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
