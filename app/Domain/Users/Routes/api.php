<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['api'])->group(function (){

    Route::middleware(['auth:admin'])->get('/user', function (Request $request) {
        return auth()->user();
    })->name('api.user');


});
