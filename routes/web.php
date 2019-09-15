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

Route::get('command', function () {	
    \Artisan::call('config:cache');
    \Artisan::call('view:clear');
});

Route::get('migrate', function () {	
    \Artisan::call('migrate');
    \Artisan::call('db:seed');
});

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Auth::routes();

//Catalogo Lotes
Route::group(['middleware' => 'auth'], function () {
		Route::get('lote/filter', 'LoteController@filter');
		Route::get('lote/grid', 'LoteController@grid');
		Route::resource('lote', 'LoteController');
});

//Permisos
Route::group(['middleware' => 'auth'], function () {
});

//Users and profiles
Route::group(['middleware' => 'auth'], function () {
	Route::get('permission/grid', 'PermissionController@grid');
	Route::resource('permission', 'PermissionController');
	
	Route::get('user/grid', 'UserController@grid');
	Route::resource('user', 'UserController');
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

