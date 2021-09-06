<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'PageController@index')->name('home');
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::get('/profile/edit', 'ProfileController@editProfileForm')->name('edit.profile');
Route::post('/profile', 'ProfileController@updateProfile')->name('update.profile');
Route::get('/client', 'PageController@newClient')->name('new.client');
Route::get('/accountant', 'PageController@newAccountant')->name('new.accountant');

Route::prefix('/project')->group(function () {
  Route::get('/new', 'ProjectController@create')->name('new.project');
  Route::get('/', 'ProjectController@index')->name('view.all.project');
  Route::get('/detail/{id}', 'ProjectController@show')->name('show.project');
  Route::get('/edit/{id}', 'ProjectController@edit')->name('edit.project');
  Route::post('/store', 'ProjectController@store')->name('store.project');
  Route::post('/update/{id}', 'ProjectController@update')->name('update.project');
  Route::get('/delete/{id}', 'ProjectController@destroy')->name('delete.project');
});

Route::prefix('/client')->group(function () {
  Route::get('/view', 'ClientController@index')->name('view.clients');
  Route::get('/detail/{id}', 'ClientController@show')->name('show.client');
  Route::get('/edit/{id}', 'ClientController@edit')->name('edit.client');
  Route::post('/update/{id}', 'ClientController@update')->name('update.client');
  Route::get('/delete/{id}', 'ClientController@destroy')->name('delete.client');
});

Route::prefix('/accountant')->group(function () {
  Route::get('/view', 'AccountantController@index')->name('view.accountants');
  Route::get('/detail/{id}', 'AccountantController@show')->name('show.accountant');
  Route::get('/edit/{id}', 'AccountantController@edit')->name('edit.accountant');
  Route::post('/update/{id}', 'AccountantController@update')->name('update.accountant');
  Route::get('/delete/{id}', 'AccountantController@destroy')->name('delete.accountant');
});

// Route::get('/accountant/view', 'PageController@viewAccountant')->name('view.accountants');
Route::get('/invoice/view', 'PageController@viewInvoice')->name('view.invoices');
Route::get('/payment/view', 'PageController@viewPayment')->name('view.payments');

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::post('register/client', 'CreateUserController@registerClient')->name('register.client');
Route::post('register/accountant', 'CreateUserController@registerAccountant')->name('register.accountant');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
