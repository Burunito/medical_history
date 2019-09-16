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

Route::get('clearbootstrap', function () {	
		if(file_exists('../bootstrap/cache/config.php'))
    	unlink('../bootstrap/cache/config.php' );
   	if(file_exists('../bootstrap/cache/packages.php'))
    	unlink('../bootstrap/cache/packages.php' );
    if(file_exists('../bootstrap/cache/services.php'))
    	unlink('../bootstrap/cache/services.php' );
});

Route::get('clearcache', function () {	
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
});

Route::get('migrate', function () {	
    \Artisan::call('migrate');
    \Artisan::call('db:seed');
});

Route::get('/buscar', 'BuscarController@index');
Route::post('/buscar', 'BuscarController@buscar');

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Auth::routes();

//Catalogo Lotes
Route::group(['middleware' => 'auth'], function () {
		Route::get('lote/filter', 'LoteController@filter');
		Route::get('lote/grid', 'LoteController@grid');
		Route::put('lote/{id}/restore','LoteController@restore');
		Route::resource('lote', 'LoteController');
});

//Catalogo Series
Route::group(['middleware' => 'auth'], function () {
		Route::get('serie/filter', 'SerieController@filter');
		Route::get('serie/grid', 'SerieController@grid');
		Route::put('serie/{id}/restore','SerieController@restore');
		Route::resource('serie', 'SerieController');
});

//Users and profiles
Route::group(['middleware' => 'auth'], function () {
	Route::get('permission/grid', 'PermissionController@grid');
	Route::put('permission/{id}/restore','PermissionController@restore');
	Route::resource('permission', 'PermissionController');
	
	Route::put('user/{id}/restore','UserController@restore');
	Route::get('user/grid', 'UserController@grid');
	Route::resource('user', 'UserController');
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

