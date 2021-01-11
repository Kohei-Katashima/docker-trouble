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
Route::get('search', 'PostController@search')->name('posts.search')->middleware('auth');
Route::resource('mypage', 'MypageController');
Route::resource('comments', 'CommentController');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
