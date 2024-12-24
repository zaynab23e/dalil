<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');