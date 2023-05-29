<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    | Model,
    | Provide the models that can be used by Dashboard package,
    | Model name should be given with path,
    | Each model should have array of column names that can be used in table
    | Ex:
    |     'models' => [
    |        'App\Models\Admin' => [
    |            'name', 'email'
    |        ],
    |        'App\Models\User' => [
    |            'id', 'name', 'email'
    |        ],
    |     ],
    |
    */

    'models-count-card' => [
        //
    ],

    'chart-data' => [
        //
    ],

    'models-table' => [
        'App\Models\Admin' => [
            //
        ],
        'App\Models\User' => [
            //
        ],
        'App\Models\HouseOwner' => [
            //
        ],
        'App\Models\Tenant' => [
            //
        ],
    ],


    /*
    |Important note
    |--------------------------------------------------------------------------
    | Bootstrap 5
    |--------------------------------------------------------------------------
    | Each class are uses Bootstrap 5, So do a verify before proceeding
    | to provide classes and styles
    | 
    */

    /*
    |--------------------------------------------------------------------------
    | Card
    |--------------------------------------------------------------------------
    | provide a color that sets the back ground for card
    | Ex:
    |   'card-background-color' => '#FFFFFF',
    */

    'card-background-color' => '#FFFFFF',

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    | Table can be styled from here, 
    | By the provided class
    | Ex:
    |   'table-style' => [
    |       'table-hover', 'table-bordered',
    |   ]
    */

    'table' => [
        'table-style' => [
            'table-hover', 'table-bordered', 'border-success',
        ],
        
        'table-search' => 'on',

        'table-color' => 'white',

        'table-text-color' => 'Black',
    ],

    'background-color' => '#0000FF',

    'navbar' => 'off',
    

    

];
