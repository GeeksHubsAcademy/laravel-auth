<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::middleware('auth:api')->get('','UserController@getAll');
    Route::post('register','UserController@register');
    Route::post('login','UserController@login');
});
