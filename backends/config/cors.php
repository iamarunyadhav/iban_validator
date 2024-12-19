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

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Ensure your API routes are covered

    'allowed_methods' => ['*'], // Or specify methods 'POST', 'GET', 'OPTIONS', etc.

    'allowed_origins' => ['http://localhost:5173'], // Adjust to match the port and host of your Vue app

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Or specify headers such as 'Content-Type', 'X-Requested-With', 'X-CSRF-Token', etc.

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // This must be true to allow cookies or authentication headers


];
