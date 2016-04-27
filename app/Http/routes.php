<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware'=>'auth',function () {
    redirect('/login');
        // return 'Hello World';
}]);
//LOGIN
Route::get('/login', 'loginController@index');
Route::post('/login', 'loginController@create');
Route::get('/logout', 'dashboardController@logout');


//REGISTER
Route::get('/register', 'registerController@index');
Route::post('/register', 'registerController@store');

//SELLER
Route::get('/seller', 'sellerController@index');


// DASHBOARD ADMIN
Route::get('/admin', 'dashboardController@indexadmin');

// ADMIN SELLER PAGE
Route::get('/admin/seller', 'sellerController@list_seller');
Route::get('/admin/seller/create', 'sellerController@create');
Route::post('/admin/seller/create', 'sellerController@store');
Route::get('/admin/seller/edit/{id}', 'sellerController@edit');
Route::post('/admin/seller/edit/{id}', 'sellerController@update');
Route::get('/admin/seller/delete/{id}', 'sellerController@destroy');

//DASHBOARD SELLER
Route::get('/dashboard', 'sellerController@index');

// ADMIN VISITOR
Route::get('/admin/visitor', 'visitorController@index');
Route::get('/admin/visitor/history/{id}', 'visitorController@history');

// ADMIN List Check in
Route::get('/admin/event/checkin', 'checkinEventController@index');

//UPLOAD EXCEL
Route::post('/visitor/excel', 'excelController@index');

Route::get('/verify/email', 'verifyController@index');
Route::post('/verify/do', 'verifyController@store');

//PDF
Route::get('/test/pdf', 'tesController@index');

//Thanks Today
Route::get('/email/thanks', 'emailController@index');

//Not Coming
Route::get('/email/missyu', 'emailController@not_coming');