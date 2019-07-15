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
    return view('site.index');
});

Auth::routes();
 

Route::get('/home', function () {
    return redirect()->intended(route('dashboard'));
})->name('home');

Route::get('/redirect', 'ServiceController@redirect')->name('login-redirect');
Route::get('/logout', 'ServiceController@logout')->name('logout');

$options = [
    'prefix' => 'admin'
];

Route::group($options, function() {

    // constants.USER.ROLE for details role

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/branch', 'BranchController@index')->name('branch-index');
    Route::get('/branch/form', 'BranchController@create')->name('branch-create')->middleware('role:1');
    Route::get('/branch/delete/{id}', 'BranchController@destroy')->name('branch-delete')->middleware('role:1');
    Route::get('/branch/form/{id}', 'BranchController@edit')->name('branch-edit')->middleware('role:1');
    Route::get('/branch/detail/{id}', 'BranchController@show')->name('branch-detail');
    Route::post('/branch/form', 'BranchController@store')->name('branch-store')->middleware('role:1');
    Route::post('/branch/form/{id}', 'BranchController@update')->name('branch-update')->middleware('role:1');

    Route::get('/agency', 'AgencyController@index')->name('agency-index')->middleware('role:1');
    Route::get('/agency/form', 'AgencyController@create')->name('agency-create')->middleware('role:1');
    Route::get('/agency/delete/{id}', 'AgencyController@destroy')->name('agency-delete')->middleware('role:1');
    Route::get('/agency/form/{id}', 'AgencyController@edit')->name('agency-edit')->middleware('role:1');
    Route::get('/agency/detail/{id}', 'AgencyController@show')->name('agency-detail');
    Route::post('/agency/form', 'AgencyController@store')->name('agency-store')->middleware('role:1');
    Route::post('/agency/form/{id}', 'AgencyController@update')->name('agency-update')->middleware('role:1');

    Route::get('/user', 'UserController@index')->name('user-index');
    Route::get('/user/form', 'UserController@create')->name('user-create')->middleware('role');
    Route::get('/user/delete/{id}', 'UserController@destroy')->name('user-delete')->middleware('role');
    Route::get('/user/form/{id}', 'UserController@edit')->name('user-edit')->middleware('role');
    Route::get('/user/detail/{id}', 'UserController@show')->name('user-detail');
    Route::post('/user/form', 'UserController@store')->name('user-store')->middleware('role');
    Route::post('/user/form/{id}', 'UserController@update')->name('user-update')->middleware('role');

    Route::get('/delivery', 'DeliveryController@index')->name('delivery-index');
    Route::get('/delivery/form', 'DeliveryController@create')->name('delivery-create')->middleware('role:1,2');
    Route::get('/delivery/delete/{id}', 'DeliveryController@destroy')->name('delivery-delete')->middleware('role:1,2');
    Route::get('/delivery/due/{id}', 'DeliveryController@edit')->name('delivery-edit')->middleware('role:1,2');
    Route::get('/delivery/detail/{id}', 'DeliveryController@show')->name('delivery-detail');
    Route::post('/delivery/form', 'DeliveryController@store')->name('delivery-store')->middleware('role:1,2');
    Route::post('/delivery/due/{id}', 'DeliveryController@update')->name('delivery-update')->middleware('role:1,2');
});

