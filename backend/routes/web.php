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

//トップページ
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

//投稿一覧
Route::resource('posts', 'PostController');
Route::get('show', 'UserController@show')->name('users.me')->middleware('auth');
Route::get('search1', 'PostController@search1')->name('posts.search');
Route::prefix('posts')->name('posts.')->group(function () {
  Route::put('/{post}/like', 'PostController@like')->name('like')->middleware('auth');
  Route::delete('/{post}/like', 'PostController@unlike')->name('unlike')->middleware('auth');
});

//ユーザー一覧
Route::resource('users', 'UserController');
Route::get('show', 'UserController@show')->name('users.me')->middleware('auth');
Route::get('search', 'UserController@search')->name('users.search');

//コメント
Route::resource('comments', 'CommentController');

//お問い合わせホーム
Route::get('contact/index', 'ContactFormController@index')->name('contact.index');
Route::post('contact/index', 'ContactFormController@post')->name('contact.post');
Route::get('contact/confirm', 'ContactFormController@confirm')->name('contact.confirm');
Route::post('contact/confirm', 'ContactFormController@send')->name('contact.send');
Route::get('contact/thanks', 'ContactFormController@thanks')->name('contact.thanks');

