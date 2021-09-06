<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'PageController@index')->name('home');
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::get('/profile/edit', 'ProfileController@editProfileForm')->name('edit.profile');
Route::post('/profile', 'ProfileController@updateProfile')->name('update.profile');
Route::get('/project/view', 'PageController@viewProject')->name('view.projects');
Route::get('/invoice/view', 'PageController@viewInvoice')->name('view.invoices');
Route::get('/payment/view', 'PageController@viewPayment')->name('view.payments');

Route::prefix('/project')->group(function () {
  Route::get('/', 'ProjectController@index')->name('view.all.project');
  Route::get('/detail/{id}', 'ProjectController@show')->name('show.project');
  Route::get('/edit/{id}', 'ProjectController@edit')->name('edit.project');
  Route::post('/update/{id}', 'ProjectController@update')->name('update.project');
});


// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

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
