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

Route::get('/', 'PublicController@index')->name('welcome');
Route::get('/session/{id}', 'AuthController@setSession')->name('setSession');

Route::get('/login', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return redirect()->intended(route('dashboard'));
})->name('home');

$options = [
    'prefix' => 'admin'
];

Route::get('/signin', 'AuthController@signin')->name('signin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group($options, function() {
        
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/mail/compose', 'MailController@compose')->name('mail-compose');
    Route::get('/mail/inbox', 'MailController@inbox')->name('mail-inbox');
    Route::get('/mail/outbox', 'MailController@outbox')->name('mail-outbox');
    Route::get('/mail/inbox/{id}', 'MailController@detailInbox')->name('mail-inbox-detail');
    Route::get('/mail/outbox/{id}', 'MailController@detailInbox')->name('mail-outbox-detail');
    Route::get('/mail/star/{type}/{id}', 'MailController@star')->name('mail-star');

    Route::post('/mail/compose', 'MailController@store')->name('mail-store');
    
});