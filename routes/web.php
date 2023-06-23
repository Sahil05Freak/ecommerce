<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
    Route::group(['middleware' => ['auth', 'role:Admin']], function () {
        Route::get('/products', 'ProductController@index')->name('products');
        Route::get('/products/create', 'ProductController@create');
        Route::post('/products', 'ProductController@store');
        Route::get('/products/{product}', 'ProductController@show');
        Route::get('/products/{product}/edit', 'ProductController@edit');
        Route::put('/products/{product}', 'ProductController@update');
        Route::delete('/products/{product}', 'ProductController@destroy');
    });
    
    Route::group(['middleware' => ['auth', 'role:Customer']], function () {
        Route::get('/productList', 'ProductController@productForCustomer')->name('productList');
        Route::post('/products/{productId}/add-to-cart', 'ProductController@addToCart');
        Route::post('/cart/add', 'CartController@addToCart');
        Route::get('/cart', 'CartController@index')->name('carts');
        Route::put('/cart/{cartItem}', 'CartController@update');
        Route::delete('/cart/{cartItem}', 'CartController@remove');

        Route::get('/cart/checkout', 'CheckoutController@checkout');
        Route::post('/cart/place-order', 'CheckoutController@placeOrder');
        Route::get('/order/confirmation', 'CheckoutController@orderConfirmation');


        // Route::get('/product', 'ProductController@index')->name('products.index');
        // Route::post('/cart/add', 'ProductController@addToCart')->name('cart.add');
        // Route::post('/checkout', 'OrderController@checkout')->name('checkout');
    });
});
