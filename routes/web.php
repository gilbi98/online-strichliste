<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//outside cart routes

Route::get('/outside', 'TallysheetController@outside_index')->name('outside');

Route::post('/new-purchase-without-category-outside', 'PurchaseController@createPurchaseWithCategoryOutside')->name('createPurchaseWithCategoryOutside');

//User routes

Route::middleware('role:user')->group(function () {
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/cart', 'TallysheetController@index')->name('cart');

    Route::post('/new-purchase-without-category', 'PurchaseController@createPurchaseWithoutCategory')->name('createPurchaseWithoutCategory');

    Route::post('/new-purchase-with-category', 'PurchaseController@createPurchaseWithCategory')->name('createPurchaseWithCategory');

    Route::get('/bills', 'BillController@indexBillsUser')->name('bills');

    Route::get('/bill/{id}', 'BillController@indexBillUser')->name('bill');

    Route::get('/profil', 'UserController@profil')->name('profil');    

    Route::post('/generate-pin', 'UserController@generatePin')->name('generatePin');

    Route::post('/change-password', 'UserController@updatePassword')->name('update-password');

    Route::post('/change-email', 'UserController@updateEmail')->name('update-email');

});

//Admin routes

Route::middleware('role:admin')->group(function () {
    
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::get('/articles', 'ArticleController@indexArticles')->name('articles');

    Route::get('/article/{id}', 'ArticleController@indexArticle')->name('article');

    Route::post('/new-article', 'ArticleController@create')->name('createArticle');

    Route::post('/refill-article', 'ArticleController@refill')->name('refillArticle');

    Route::post('/update-article-data/{id}', 'ArticleController@updateArticleData')->name('changeArticleData');

    Route::post('/update-article-stockdata/{id}', 'ArticleController@updateArticleStockData')->name('changeArticleStockData');

    Route::get('/stock', 'ArticleController@indexStock')->name('stock');

    Route::post('/update-articles-stockdata', 'ArticleController@updateArticlesStock')->name('changeArticlesStock');

    Route::post('/new-category', 'CategoryController@create')->name('createCategory');

    Route::get('/categories', 'CategoryController@indexCategories')->name('categories');

    Route::get('/purchases', 'PurchaseController@index')->name('purchases');

    Route::post('/new-invoice', 'InvoiceController@create')->name('createInvoice');

    Route::get('/invoices', 'InvoiceController@indexInvoices')->name('invoices');

    Route::get('/invoice/{id}', 'InvoiceController@indexInvoice')->name('invoice');

    Route::get('/billAdmin/{id}', 'BillController@indexBillAdmin')->name('billAdmin');

    Route::post('/billToPaid/{id}', 'BillController@setBillToPaid')->name('billToPaid');

    Route::get('download-pdf/{id}', 'BillController@downloadBill')->name('downloadBill');

    Route::get('/users', 'UserController@indexUsers')->name('users');

    Route::post('/user-to-admin/{id}', 'UserController@setUserToAdmin')->name('userToAdmin');

    Route::post('/user-to-user/{id}', 'UserController@setUserToUser')->name('userToUser');

});

