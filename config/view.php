<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Here you may specify an array of paths that should be searched for
    | your views. The typical Laravel view path has already been defined.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade views will be
    | stored for your application. A sensible default has been set for you.
    |
    */

    'compiled' => env('VIEW_COMPILED_PATH', '/tmp/storage/framework/views'),

];
