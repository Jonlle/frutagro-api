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
        Route::put('/admins/{admin}/lock', 'API\CustomerController@lock')->name('admin.lock');
    });

    Route::prefix('/')->group(function () {
        Route::apiResources([
            'users' => 'API\UserController',
            'suppliers' => 'API\SupplierController',
            'customers.addresses' => 'API\CustomerAddressController',
            'permissions' => 'API\PermissionController',
            'roles' => 'API\RoleController',
            'categories' => 'API\CategoryController',
            'currencies' => 'API\CurrencyCodeController',
            'products' => 'API\ProductController',
            'orders' => 'API\OrderController',
            'financial-entities' => 'API\FinancialEntityController',
            'payment-types' => 'API\PaymentTypeController',
            'payment-methods' => 'API\AdminPaymentMethodController',
        ]);
        Route::put('categories/{category}/lock', 'API\CategoryController@lock')->name('category.lock');
        Route::put('products/{product}/lock', 'API\ProductController@lock')->name('product.lock');
        Route::put('products-attributes/{attribute}/lock', 'API\ProductController@lockAttribute')->name('product.attribute.lock');
    });

    Route::get('states', 'API\AddressController@states')->name('states.index');
    Route::get('states/{state}/cities', 'API\AddressController@cities')->name('states.cities.index');
    Route::get('states/{state}/municipalities', 'API\AddressController@municipalities')->name('states.municipalities.index');
    Route::get('municipalities/{municipality}/parishes', 'API\AddressController@parishes')->name('municipality.parishes.index');
});
