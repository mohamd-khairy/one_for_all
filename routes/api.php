<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/************************* public ********************* */
Route::group([], function () {
    Route::post('register', [\App\Http\Controllers\Api\UserController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\UserController::class, 'login']);
    Route::post('social-login', [\App\Http\Controllers\Api\UserController::class, 'social_login']);
    Route::post('forget-password', [\App\Http\Controllers\Api\UserController::class, 'forget_password']);
    Route::post('new-password', [\App\Http\Controllers\Api\UserController::class, 'new_password']);

    Route::get('categories', [\App\Http\Controllers\Api\CategoryController::class, 'get_categories']);
    Route::get('sub-categories', [\App\Http\Controllers\Api\CategoryController::class, 'get_sub_categories']);
});

/************************* private ********************* */
Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
