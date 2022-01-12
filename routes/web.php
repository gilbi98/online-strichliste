<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//User routes

Route::get('/home', 'HomeController@index')->name('home')->middleware(['role:enduser']);

Route::get('/cart', 'TallysheetController@index')->name('cart')->middleware(['role:enduser']);

Route::post('/new-purchase-without-category', 'PurchaseController@createPurchaseWithoutCategory')->name('createPurchaseWithoutCategory')->middleware(['role:enduser']);

Route::post('/new-purchase-with-category', 'PurchaseController@createPurchaseWithCategory')->name('createPurchaseWithCategory')->middleware(['role:enduser']);

Route::get('/bills', 'BillController@bills_index')->name('bills')->middleware(['role:enduser']);

Route::get('/bill/{id}', 'BillController@bill_index')->name('bill')->middleware(['role:enduser']);

//outside cart routes

Route::get('/outside', 'TallysheetController@outside_index')->name('outside');

Route::post('/new-purchase-without-category-outside', 'PurchaseController@createPurchaseWithoutCategoryOutside')->name('createPurchaseWithoutCategoryOutside');

//Admin routes

