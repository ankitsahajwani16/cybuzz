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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
Auth::routes(['verify' => true]); 
Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function()
{
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/attandance', 'HomeController@markAttandance')->name('attandance');
});
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::match(['get','post'],'/report', 'AdminController@index')->name('report');
    
});
Route::get('/error', 'HomeController@error')->name('error');