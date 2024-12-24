<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;

Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');
 
///////////////////////////////////////User Public Routes///////////////////////////////////////
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/forgot-password',[AuthController::class,'forgotPassword']);
Route::post('/reset-password',[AuthController::class,'resetPassword']);

///////////////////////////////////////User Protected Routes////////////////////////////////////
Route::group(['middleware'=>['auth:sanctum']], function(){
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/profile',[ProfileController::class,'getProfile']);
Route::post('/update-profile',[ProfileController::class,'updateProfile']);
Route::post('/change-password',[ProfileController::class,'changePassword']);
Route::delete('/delete-account',[ProfileController::class,'deleteAccount']);
});