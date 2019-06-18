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

Route::get('/canvas', 'ChatsController@fetchCanvas');
Route::post('/canvas', 'ChatsController@sendCanvas');
Route::get('/canvas', 'ChatsController@getCanvas');


//Route::get('/messages', 'ChatsController@truncate');

Route::resource('user', 'UserController');

Route::get('/index', 'UserController@index')->name('index');

Route::get('/settings', 'UserController@edit')->name('settings');

Route::get('/', 'welcome@index');
Route::get('/welcome', 'welcome@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/', function() {
    broadcast(new NewMessage('some data'));

    return view('welcome');
});

Route::get('/chats', 'ChatsController@index');
