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
  Route::get('/', 'ProjectController@index')->name('view.all.project');
  Route::get('/detail/{id}', 'ProjectController@show')->name('show.project');
  Route::get('/edit/{id}', 'ProjectController@edit')->name('edit.project');
  Route::post('/update/{id}', 'ProjectController@update')->name('update.project');
  Route::get('/download/file/{id}', 'ProjectController@downloadProjectFile')->name('download.project.file');
});

Route::prefix('/invoice')->group(function () {
  Route::get('/view', 'InvoiceController@index')->name('view.invoices');
  Route::get('/detail/{id}', 'InvoiceController@show')->name('show.invoice');
  Route::get('/edit/{id}', 'InvoiceController@edit')->name('edit.invoice');
  Route::post('/update/{id}', 'InvoiceController@update')->name('update.invoice');
  Route::get('/show/evidence/{id}', 'InvoiceController@showPaymentEvidence')->name('show.payment.evidence');
  Route::get('/download/invoice/{id}', 'InvoiceController@downloadInvoiceAsPDF')->name('download.invoice');
});

Route::prefix('/payment')->group(function () {
  Route::get('/view', 'PaymentController@index')->name('view.payments');
  Route::get('/download/receipt/{id}', 'PaymentController@downloadReceiptAsPDF')->name('download.payment');
});

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('reset/password', 'ProfileController@resetPassword')->name('reset.password');




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
