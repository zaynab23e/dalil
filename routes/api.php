<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');
