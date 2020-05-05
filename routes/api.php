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
        Route::prefix('/admin')->group(function () {
            Route::post('register', 'API\AuthController@registerAdmin')->name('auth.registerAdmin');
            Route::post('login', 'API\AuthController@loginAdmin')->name('auth.loginAdmin');
            Route::post('logout', 'API\AuthController@logoutAdmin')->name('auth.logoutAdmin');
        });
        Route::get('user', 'API\AuthController@user')->name('auth.user');

        Route::prefix('/customer')->group(function () {
            Route::post('register', 'API\AuthController@register')->name('auth.register');
            Route::post('login', 'API\AuthController@login')->name('auth.login');
            Route::post('logout', 'API\AuthController@logout')->name('auth.logout');
        });
    });

    Route::apiResource('/permissions', 'API\PermissionController');
    Route::apiResource('/roles', 'API\RoleController');
    Route::apiResource('/users', 'API\UserController');
    Route::apiResource('/categories', 'API\CategoryController');

});
