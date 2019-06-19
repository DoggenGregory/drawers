<?php

use App\Events\NewMessage;

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

Route::get('/messages', 'ChatsController@fetchMessages');
Route::post('/messages', 'ChatsController@sendMessage');

Route::post('/chats', 'ChatsController@sendCanvas');
Route::get('/chats', 'ChatsController@getCanvas');


//Route::get('/messages', 'ChatsController@truncate');

Route::resource('user', 'UserController');

Route::get('/index', 'UserController@index')->name('index');

Route::get('/settings', 'UserController@edit')->name('settings');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/chats', 'ChatsController@index');
