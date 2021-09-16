<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'DashboardController@index')->name('home');

Route::prefix('/profile')->group(function () {
  Route::get('/', 'ProfileController@profile')->name('profile');
  Route::get('/edit', 'ProfileController@editProfileForm')->name('edit.profile');
  Route::post('/', 'ProfileController@updateProfile')->name('update.profile');
});

Route::prefix('/project')->group(function () {
  Route::get('/new', 'ProjectController@create')->name('new.project');
  Route::get('/', 'ProjectController@index')->name('view.all.project');
  Route::get('/detail/{id}', 'ProjectController@show')->name('show.project');
  Route::get('/edit/{id}', 'ProjectController@edit')->name('edit.project');
  Route::post('/store', 'ProjectController@store')->name('store.project');
  Route::post('/update/{id}', 'ProjectController@update')->name('update.project');
  Route::get('/delete/{id}', 'ProjectController@destroy')->name('delete.project');
  Route::get('/download/file/{id}', 'ProjectController@downloadProjectFile')->name('download.project.file');
});

Route::prefix('/client')->group(function () {
  Route::get('/view', 'ClientController@index')->name('view.clients');
  Route::get('/detail/{id}', 'ClientController@show')->name('show.client');
  Route::get('/edit/{id}', 'ClientController@edit')->name('edit.client');
  Route::post('/update/{id}', 'ClientController@update')->name('update.client');
  Route::get('/delete/{id}', 'ClientController@destroy')->name('delete.client');
  Route::get('/reset/password/{id}', 'ClientController@resetPassword')->name('reset.client.password');
});

Route::prefix('/accountant')->group(function () {
  Route::get('/view', 'AccountantController@index')->name('view.accountants');
  Route::get('/detail/{id}', 'AccountantController@show')->name('show.accountant');
  Route::get('/edit/{id}', 'AccountantController@edit')->name('edit.accountant');
  Route::post('/update/{id}', 'AccountantController@update')->name('update.accountant');
  Route::get('/delete/{id}', 'AccountantController@destroy')->name('delete.accountant');
  Route::get('/reset/password/{id}', 'AccountantController@resetPassword')->name('reset.accountant.password');
});

Route::prefix('/invoice')->group(function () {
  Route::get('/view', 'InvoiceController@index')->name('view.invoices');
  Route::get('/new', 'InvoiceController@create')->name('new.invoice');
  Route::post('/store', 'InvoiceController@store')->name('store.invoice');
  Route::get('/detail/{id}', 'InvoiceController@show')->name('show.invoice');
  Route::get('/edit/{id}', 'InvoiceController@edit')->name('edit.invoice');
  Route::get('/confirm/payment/{id}', 'InvoiceController@confirmPayment')->name('confirm.payment.invoice');
  Route::post('/update/{id}', 'InvoiceController@update')->name('update.invoice');
  Route::get('/delete/{id}', 'InvoiceController@destroy')->name('delete.invoice');
  Route::get('/show/evidence/{id}', 'InvoiceController@showPaymentEvidence')->name('show.payment.evidence');
  Route::get('/download/invoice/{id}', 'InvoiceController@downloadInvoiceAsPDF')->name('download.invoice');
});

Route::prefix('/payment')->group(function () {
  Route::get('/view', 'PaymentController@index')->name('view.payments');
  Route::get('/delete/{id}', 'PaymentController@destroy')->name('delete.payment');
  Route::get('/download/receipt/{id}', 'PaymentController@downloadReceiptAsPDF')->name('download.payment');
});

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('reset/password', 'ProfileController@resetPassword')->name('reset.password');
Route::post('reset/password/email', 'Auth\LoginController@resetPasswordThroughEmail')->name('reset.password.email');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::post('register/client', 'CreateUserController@registerClient')->name('register.client');
Route::post('register/accountant', 'CreateUserController@registerAccountant')->name('register.accountant');
Route::get('/client', 'CreateUserController@newClient')->name('new.client');
Route::get('/accountant', 'CreateUserController@newAccountant')->name('new.accountant');

// // Reset Password
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// // Confirm Password
// Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
