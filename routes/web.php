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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomePageController@index');
Route::post('/save-phone','HomePageController@savePhoneOfCustomer')->name('savePhone');


Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'company', 'namespace' => 'Company'], function(){
        Route::get('orders', 'OrderController@index')->name('company-homepage');
        Route::post('orders', 'OrderController@store')->name('company-order-add');
        Route::get('order-delete/{id}', 'OrderController@destroy')->name('company-order-delete');

        Route::get('couriers', 'CourierController@index')->name('company-couriers');
        Route::post('couriers', 'CourierController@store')->name('company-courier-add');
        Route::get('courier-delete/{id}', 'CourierController@destroy')->name('company-courier-delete');
    });
});



