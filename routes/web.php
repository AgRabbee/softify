<?php

Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('/signin','Auth\AuthController@getSignin');
Route::post('/signin','Auth\AuthController@Signin');
Route::get('/signup','Auth\AuthController@getSignup');
Route::post('/signup','Auth\AuthController@Signup');

# GOOGLE LOGIN
Route::get('auth/google', 'Auth\AuthController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\AuthController@handleGoogleCallback');

# FACEBOOK LOGIN
Route::get('auth/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookCallback');

Route::get('/add-to-cart','PagesController@addToCart');

    // admin
    // -----------------------------------------------------------------------

Route::group(['middleware'=>['auth','admin'],'prefix'=>'dashboard'],function(){

    Route::get('/', 'DashboardController@index');
    Route::get('/all/products','ProductController@index');
    Route::get('/add/product','ProductController@create');
    Route::post('/add/product','ProductController@store');
    Route::post('/product/edit/{id}','ProductController@update');
    Route::post('/product/delete/{id}','ProductController@destroy');

    Route::get('/allorders','DashboardController@allOrders');



});

Route::group(['middleware'=>['client','auth']],function(){

    Route::get('/cart','PagesController@cart');
    Route::get('/remove-from-cart','PagesController@removeFromCart');
    Route::get('/makePayment','PagesController@makePayment');

});
