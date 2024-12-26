<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', [AuthController::class, 'loadLoginPage'])->name('loginPage');
Route::post('/login-admin', [AuthController::class, 'loginUser'])->name('loginUser');

//protected routes
Route::middleware(['auth.admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout'); 
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

});
