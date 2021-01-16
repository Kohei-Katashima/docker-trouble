<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController')->middleware('auth');
Route::get('search1', 'PostController@search1')->name('posts.search')->middleware('auth');

Route::resource('users', 'UserController');
Route::get('show', 'UserController@show')->name('users.me')->middleware('auth');
Route::get('search', 'UserController@search')->name('users.search');
Route::resource('mypage', 'MypageController');

Route::resource('profile','ProfileController');
// Route::get('search', 'ProfileController@search')->name('profile.search')->middleware('auth');

Route::resource('comments', 'CommentController');

//お問い合わせホーム
Route::get('contact/index', 'ContactFormController@index')->name('contact.index');
Route::post('contact/index', 'ContactFormController@post')->name('contact.post');
Route::get('contact/confirm', 'ContactFormController@confirm')->name('contact.confirm');
Route::post('contact/confirm', 'ContactFormController@send')->name('contact.send');
Route::get('contact/thanks', 'ContactFormController@thanks')->name('contact.thanks');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
