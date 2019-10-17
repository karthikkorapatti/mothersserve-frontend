<?php

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

// Auth::routes();

Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function() {
	Route::post('is-loggedin', 'Auth\LoginController@isLoggedIn');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('register', 'Auth\LoginController@register');
	Route::post('logout', 'Auth\LoginController@logout');

	Route::post('confirm-order', 'OrdersController@store');
	Route::post('orders/{id}/confirm', 'OrdersController@confirm')->name('orders.confirm');
	Route::get('orders/{id}/confirmed', 'OrdersController@confirmed');

	Route::get('restaurants', 'RestaurantsController@index');
	Route::get('restaurants/{id}', 'RestaurantsController@show');
	Route::get('addresses', 'AddressesController@index');
	Route::post('addresses', 'AddressesController@store');
	Route::get('payments/{id}/callback', 'PaymentsController@callback');
});

Route::get('/{vue?}', function () {
    return view('vue');
})->where('vue', '[\/\w\.-]*');


// Route::get('/home', 'HomeController@index')->name('home');
