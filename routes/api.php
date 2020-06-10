<?php

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::get('user', 'API\AuthController@user')->name('auth.user');
        Route::post('login', 'API\AuthController@login')->name('auth.login');
        Route::post('logout', 'API\AuthController@logout')->name('auth.logout');

        Route::prefix('/admin')->group(function () {
            Route::post('register', 'API\AuthController@registerAdmin')->name('auth.registerAdmin');
        });

        Route::prefix('/customer')->group(function () {
            Route::post('register', 'API\AuthController@register')->name('auth.register');
        });
    });

    Route::prefix('/users')->group(function () {
        Route::apiResource('/admins', 'API\AdminController');
        Route::apiResource('/customers', 'API\CustomerController');
    });

    Route::apiResource('/users', 'API\UserController');
    Route::apiResource('/permissions', 'API\PermissionController');
    Route::apiResource('/roles', 'API\RoleController');
    Route::apiResource('/categories', 'API\CategoryController');
    Route::apiResource('/currencies', 'API\CurrencyCodeController');
    Route::apiResource('/products', 'API\ProductController');

});
