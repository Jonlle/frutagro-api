<?php

use Illuminate\Http\Request;

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
        Route::put('remember-token', 'API\AuthController@updateRememberToken')->name('auth.updateRememberToken');

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
        Route::put('/customers/{customer}/lock', 'API\CustomerController@lock')->name('customer.lock');
    });

    Route::prefix('/')->group(function () {
        Route::apiResources([
            'users' => 'API\UserController',
            'permissions' => 'API\PermissionController',
            'roles' => 'API\RoleController',
            'categories' => 'API\CategoryController',
            'currencies' => 'API\CurrencyCodeController',
            'products' => 'API\ProductController',
        ]);
        Route::put('categories/{category}/lock', 'API\CategoryController@lock')->name('category.lock');
    });

    Route::get('estados', 'API\AddressController@estados')->name('estados.index');
    Route::get('estados/{estado}/ciudades', 'API\AddressController@ciudades')->name('estados.ciudades.index');
    Route::get('estados/{estado}/municipios', 'API\AddressController@municipios')->name('estados.municipios.index');
    Route::get('municipios/{municipio}/parroquias', 'API\AddressController@parroquias')->name('municipio.parroquias.index');


});
