<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function (Request $request) {
    $admin   = \App\Domain\Users\Models\Admin::find('db44e888-ac11-4c00-8dc7-74596d2bf7d1');
    $tokens = $admin->createTokens();

    return [
        'access_token'  => $tokens['access_token'],
        'refresh_token' => $tokens['refresh_token'],
        'decoded' => jwt_decode($tokens['access_token'])
    ];
});

Route::middleware('auth:admin')->get('/postman', function (Request $request) {
    return auth()->user();
});
