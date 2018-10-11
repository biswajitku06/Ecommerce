<?php

Route::get('index','user\HomeController@home')->name('index');
Route::get('products/{url}','user\HomeController@getproductlist')->name('productlist');
Route::get('product-details/{id}','user\HomeController@productdetails')->name('Productdetails');
Route::get('/get-product-price','user\HomeController@getProductPrice');
Route::post('add-to-cart','user\HomeController@addToCart')->name('add_to_cart');
Route::match(['get','post'],'cart','user\HomeController@Cart');
Route::get('cart/{id}','user\HomeController@deleteItem')->name('delete-item-cart');
Route::get('increment-quantity/{id}','user\HomeController@incrementQuantity')->name('increment-quantity');
Route::get('decrement-quantity/{id}','user\HomeController@decrementQuantity')->name('decrement-quantity');
Route::get('update-price/{id}','user\HomeController@updatePrice');
Route::post('cart-apply-coupon','user\HomeController@applyCoupon')->name('coupon-apply');

Route::get('login-register','user\UserController@loginRegister')->name('login-register');
Route::post('login-register','user\UserController@register')->name('register');
Route::get('check_email','user\UserController@check_email');
Route::get('logout','user\UserController@logout')->name('logout');
Route::post('login','user\UserController@login')->name('login');

Route::group(['middleware'=>['frontlogin']],function(){
    Route::match(['get','post'],'account','user\UserController@updateaccount')->name('account');
    Route::post('update-password','user\UserController@updatePassword')->name('update-password');
    Route::get('check-password','user\UserController@checkPassword');
});