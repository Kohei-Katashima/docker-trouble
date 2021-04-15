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

// ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

//投稿一覧
Route::resource('posts', 'PostController');
Route::get('search1', 'PostController@search1')->name('posts.search');
Route::prefix('posts')->name('posts.')->group(function () {
  Route::put('/{post}/like', 'PostController@like')->name('like')->middleware('auth');
  Route::delete('/{post}/like', 'PostController@unlike')->name('unlike')->middleware('auth');
});

Route::get('/tags/{tag_name}', 'TagController@show')->name('tags.show');

//ユーザー一覧
Route::resource('users', 'UserController');
Route::get('search', 'UserController@search')->name('users.search');
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::put('/{name}/edit', 'UserController@edit')->name('edit');
    Route::put('/{name}/update', 'UserController@update')->name('update');
  Route::middleware('auth')->group(function () {
      Route::put('/{name}/follow', 'UserController@follow')->name('follow');
      Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

//コメント
Route::resource('comments', 'CommentController');

//お問い合わせホーム
Route::get('contact/index', 'ContactFormController@index')->name('contact.index');
Route::post('contact/index', 'ContactFormController@post')->name('contact.post');
Route::get('contact/confirm', 'ContactFormController@confirm')->name('contact.confirm');
Route::post('contact/confirm', 'ContactFormController@send')->name('contact.send');
Route::get('contact/thanks', 'ContactFormController@thanks')->name('contact.thanks');