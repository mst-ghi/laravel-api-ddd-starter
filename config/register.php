<?php

/*
|--------------------------------------------------------------------------
| Register of domain features
|--------------------------------------------------------------------------
|
| Measure all values true or false
|
*/

return [
    'commands'     => env('REGISTER_COMMANDS', true),
    'factories'    => env('REGISTER_FACTORIES', true),
    'migrations'   => env('REGISTER_MIGRATIONS', false),
    'translations' => env('REGISTER_TRANSLATIONS', true),
    'views'        => env('REGISTER_VIEWS', true),
    'policies'     => env('REGISTER_POLICIES', true),
    'api_routes'   => env('REGISTER_API_ROUTES', true),
];
