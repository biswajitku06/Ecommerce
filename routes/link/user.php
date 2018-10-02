<?php

Route::get('index','user\HomeController@home')->name('index');
Route::get('products/{url}','user\HomeController@getproductlist')->name('productlist');