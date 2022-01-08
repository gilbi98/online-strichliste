<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart', 'TallysheetController@index')->name('cart');

Route::post('/new-purchase-without-category', 'PurchaseController@createPurchaseWithoutCategory')->name('createPurchaseWithoutCategory');

Route::post('/new-purchase-with-category', 'PurchaseController@createPurchaseWithCategory')->name('createPurchaseWithCategory');

Route::get('/bills', 'BillController@bills_index')->name('bills');

Route::get('/bill/{id}', 'BillController@bill_index')->name('bill');