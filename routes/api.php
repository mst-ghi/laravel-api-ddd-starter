<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->get('/postman', function (Request $request) {
    return auth()->user();
});
