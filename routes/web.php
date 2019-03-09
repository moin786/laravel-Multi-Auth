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

Route::get('/', function () {
    return view('welcome');
});

Route::get('customer/upload-image','ImageController@uploadImageForm')->name('customer.upload-image');
Route::post('customer/storeimage','ImageController@uploadImage')->name('customer.storeimage');
Route::get('customer/upload-pdf','ImageController@uploadPdfForm')->name('customer.upload-pdf');
Route::get('customer/image','ImageController@imageRandomView')->name('customer.image-random-view');

Route::get('customer/login','Customer\LoginController@showLoginForm')->name('customer.login');
Route::post('customer/login','Customer\LoginController@login');
Route::post('customer/logout','Customer\LoginController@logout')->name('customer.logout');
Route::post('customer/password/email','Customer\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
Route::get('customer/password/reset','Customer\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
Route::get('customer/password/reset','Customer\ResetPasswordController@reset')->name('customer.password.update');
Route::get('customer/password/reset/{token}','Customer\ResetPasswordController@showResetForm ')->name('customer.password.reset');
Route::get('customer/register','Customer\RegisterController@showRegistrationForm')->name('customer.register');
Route::post('customer/register','Customer\RegisterController@register');


Route::get('admin/login','Admin\LoginController@showLoginForm')->name('admin.login');
//Route::post('admin/login','Admin\LoginController@login');
Route::post('admin/logout','Admin\LoginController@logout')->name('admin.logout');
Route::post('admin/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::get('admin/password/reset','Admin\ResetPasswordController@reset')->name('admin.password.update');
Route::get('admin/password/reset/{token}','Admin\ResetPasswordController@showResetForm ')->name('admin.password.reset');
Route::get('admin/register','Admin\RegisterController@showRegistrationForm')->name('admin.register');
Route::post('admin/register','Admin\RegisterController@register');


//Route::get('manager/login','Manager\LoginController@showLoginForm')->name('manager.login');
//Route::post('manager/login','Manager\LoginController@login');
Route::post('manager/logout','Manager\LoginController@logout')->name('manager.logout');
Route::post('manager/password/email','Manager\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');
Route::get('manager/password/reset','Manager\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
Route::get('manager/password/reset','Manager\ResetPasswordController@reset')->name('manager.password.update');
Route::get('manager/password/reset/{token}','Manager\ResetPasswordController@showResetForm ')->name('manager.password.reset');
Route::get('manager/register','Manager\RegisterController@showRegistrationForm')->name('manager.register');
Route::post('manager/register','Manager\RegisterController@register');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('customer/home', 'CustomerController@index')->name('customer.home');
Route::get('admin/home', 'AdminController@index')->name('admin.home');
Route::get('manager/home', 'ManagerController@index')->name('manager.home');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
