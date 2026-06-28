<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Active Languages
    |--------------------------------------------------------------------------
    |
    | Language names whose mappings should be merged and applied together.
    | Names must match keys in mappings or custom_mappings.
    | To add a new language: define it in custom_mappings, then add its name here.
    |
    */
    'combined_languages' => [
        'persian',
        'arabic',
    ],

    /*
    |--------------------------------------------------------------------------
    | Built-in Mappings
    |--------------------------------------------------------------------------
    */
    'mappings' => [
        'persian' => [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
        ],
        'arabic' => [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Mappings
    |--------------------------------------------------------------------------
    |
    | Add new languages here and include their name in combined_languages.
    |
    */
    'custom_mappings' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Excluded Routes
    |--------------------------------------------------------------------------
    |
    | Routes whose input should not be normalized.
    | Use route name, path, or wildcard (*) patterns.
    |
    | Examples:
    | - 'api/v1/webhook'
    | - 'dashboard.*'
    | - 'admin/*'
    |
    */
    'except' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto-register Middleware
    |--------------------------------------------------------------------------
    |
    | When true, middleware is automatically added to all requests.
    | Set to false for manual registration and use the 'normalize.numbers' alias.
    |
    */
    'auto_middleware' => true,

];
