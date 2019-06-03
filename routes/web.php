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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user', 'UserController');

Route::get('/index', 'UserController@index')->name('index');

Route::get('/settings', 'UserController@edit')->name('settings');

Route::get('/', 'welcome@index')->name('home');
Route::get('/welcome', 'welcome@index')->name('home');
Route::get('/greg', 'welcome@index')->name('piemels');
