
<?php

// Authentication

Route::get('/','LoginController@login')->name('login');
Route::get('registration','LoginController@registration')->name('registration');
Route::post('register','LoginController@register')->name('register');
Route::Post('post-login','LoginController@postlogin')->name('postlogin');
Route::get('forget-password','LoginController@forgetPassword')->name('forgetPassword');
Route::post('forget-password-process', 'LoginController@forgetPasswordProcess')->name('forgetPasswordProcess');
Route::get('forget-password-reset', 'LoginController@forgetPasswordReset')->name('forgetPasswordReset');
Route::get('forget-password-change/{reset_code}','LoginController@forgetPassChange')->name('forgetPasswordChange');
Route::post('forget-password-reset-process/{reset_code}', 'LoginController@forgetPasswordResetProcess')->name('forgetPasswordResetProcess');
Route::get('logout','LoginController@logout')->name('logout');

Route::group(['middleware'=>['auth']],function(){
    Route::get('admin-dashboard','admin\DashboardController@showdashboard')->name('adminDashboard');
    Route::get('settings','admin\DashboardController@showsettings')->name('settings');
    Route::get('/admin/check_password','admin\DashboardController@checkpass');
    Route::post('update-password','admin\DashboardController@updatePassword')->name('updatePassword');

    //category
    Route::match(['get','post'],'add-category','admin\CategoryController@addCategory')->name('addCategory');
    Route::match(['get','post'],'view-category','admin\CategoryController@viewCategory')->name('viewCategory');
    Route::match(['get','post'],'edit-category/{id}','admin\CategoryController@editCategory')->name('editCategory');
    Route::get('delete-categories/{id}','admin\CategoryController@deleteCategory')->name('deleteCategory');


    //product
    Route::match(['get','post'],'add-product','admin\ProductController@addProduct')->name('addProduct');
    Route::match(['get','post'],'view-product','admin\ProductController@viewProduct')->name('viewProduct');
    Route::match(['get','post'],'edit-product/{id}','admin\ProductController@editProduct')->name('editProduct');
    Route::get('delete-product-image/{id}','admin\ProductController@deleteimage')->name('deleteimage');
    Route::get('delete-product/{id}','admin\ProductController@deleteProduct');

    //products Attributes
    Route::match(['get','post'],'add-product-attribute/{id}','admin\ProductController@addProductAttribute')->name('addProductAttribute');
    Route::get('add-product-attribute/delete-product_attribute/{id}','admin\ProductController@deleteproductattribute');
});



