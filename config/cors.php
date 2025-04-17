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
  /*
     * You can enable CORS for one or multiple paths.
     */
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'register'],

    /*
     * Matches the request method. `['*']` allows all methods.
     */
    'allowed_methods' => ['*'],

    /*
     * Matches the request origin. `['*']` allows all origins.
     * For production, list your specific domains.
     */
    'allowed_origins' => ['https://listing-gamma.vercel.app'],
    
    // Use this during development to allow all origins:
    // 'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    /*
     * Sets the Access-Control-Allow-Headers response header.
     */
    'allowed_headers' => ['*'],

    /*
     * Sets the Access-Control-Expose-Headers response header.
     */
    'exposed_headers' => false,

    /*
     * Sets the Access-Control-Max-Age response header.
     */
    'max_age' => 0,

    /*
     * Sets the Access-Control-Allow-Credentials header.
     * Important for cookies/authenticated requests.
     */
    'supports_credentials' => true, 
    'same_site' => 'lax', // Change to 'none' if using HTTPS and cross-domain cookies

];
