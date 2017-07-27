<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nasa Api Info
    |--------------------------------------------------------------------------
    | Credentials and Endpoint to access the
    | Near Earth Object Web Service API
    |
    */

    'api_token' => env('NASA_API', null),
    'endpoint' => 'https://api.nasa.gov/neo/rest/v1/',
];
