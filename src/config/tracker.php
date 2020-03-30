<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routes Middleware
    |--------------------------------------------------------------------------
    |
    | This option controls the middlewares that protects your tracker 
    | routes and by defualt this option will be empty.
    | Example: ['auth', 'web']
    |
    */
    'middlewares'   => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Routes Prefix
    |--------------------------------------------------------------------------
    |
    | This option controls of the tracker routes and by defualt
    | it will be "tracker".
    |
    */
    'prefix'   => 'tracker',

    /*
    |--------------------------------------------------------------------------
    | Do Not Track
    |--------------------------------------------------------------------------
    |
    | This option used to disable Tracker for some IP addresses,
    | by default this option will be empty. 
    |
    | Example: ['127.0.0.1', '10.0.0.0']
    |
    */
    'not_ips'   => [
        
    ],

];