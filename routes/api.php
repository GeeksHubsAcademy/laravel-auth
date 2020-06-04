<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::post('register','UserController@register');
    Route::post('login','UserController@login');
});
