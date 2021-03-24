<?php

use Illuminate\Support\Facades\Route;

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
            'tags' => 'API\TagController',
            'categories' => 'API\CategoryController',
            'currencies' => 'API\CurrencyCodeController',
            'products' => 'API\ProductController',
            'orders' => 'API\OrderController',
            'financial-entities' => 'API\FinancialEntityController',
            'payment-types' => 'API\PaymentTypeController',
            'bank-data' => 'API\BankDataController',
            'payment-methods' => 'API\AdminPaymentMethodController',
            'social-media' => 'API\SocialMediaController',
            'logo-favicon' => 'API\LogoFaviconController',
            'information-text' => 'API\InformationTextController',
            'delivery-methods' => 'API\DeliveryMethodController',
            'carousel-banners' => 'API\CarouselBannerController',
            'general-banners' => 'API\GeneralBannerController',
            'mission-vision' => 'API\MissionVisionController',
            'info-about-us' => 'API\InfoAboutUsController',
        ]);
        Route::put('roles/{role}/status', 'API\RoleController@status')->name('role.status');
        Route::put('categories/{category}/lock', 'API\CategoryController@lock')->name('category.lock');
        Route::get('categories/{category}/products', 'API\ProductController@getByCategory')->name('categories.products.index');
        Route::get('categories/{category}/products', 'API\ProductController@getByCategory')->name('categories.products.index');
        Route::put('products/{product}/lock', 'API\ProductController@lock')->name('product.lock');
        Route::put('products-attributes/{attribute}/lock', 'API\ProductController@lockAttribute')->name('product.attribute.lock');
        Route::get('products/{product}/recommended', 'API\ProductController@getRecomended')->name('product.getRecomended');
        Route::put('suppliers/{id}/status', 'API\SupplierController@status')->name('supplier.status');
        Route::put('payment-methods/{id}/lock', 'API\AdminPaymentMethodController@lock')->name('paymentMethod.lock');
        Route::put('bank-data/{id}/lock', 'API\BankDataController@lock')->name('bankData.lock');
        Route::post('social-media/upsert', 'API\SocialMediaController@upsert')->name('socialMedia.upsert');
        Route::put('social-media/{id}/lock', 'API\SocialMediaController@lock')->name('socialMedia.lock');
        Route::put('currencies/{id}/status', 'API\CurrencyCodeController@status')->name('currency.status');
        Route::post('currencies/{id}/default', 'API\CurrencyCodeController@setDefaultCurrency')->name('currency.setDefaultCurrency');
        Route::put('delivery-methods/{id}/status', 'API\DeliveryMethodController@status')->name('deliveryMethod.status');
        Route::put('carousel-banners/{id}/status', 'API\CarouselBannerController@status')->name('carouselBanner.status');
    });

    Route::get('states', 'API\AddressController@states')->name('states.index');
    Route::get('states/{state}/cities', 'API\AddressController@cities')->name('states.cities.index');
    Route::get('states/{state}/municipalities', 'API\AddressController@municipalities')->name('states.municipalities.index');
    Route::get('municipalities/{municipality}/parishes', 'API\AddressController@parishes')->name('municipality.parishes.index');
});
