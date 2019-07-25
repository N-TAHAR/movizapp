<?php
use App\Http\Controllers\TestsController;
use App\Http\Controllers\CommentsController;

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

Route::get('/', 'TestsController@home');

Route::get('/search', 'TestsController@list');

Route::get('/movie/{movie_id}', 'TestsController@movie')->name('movie');
Route::get('/movie/comments/delete/{comment_id}', 'CommentsController@delete')->name('movie/comments/delete');
Route::get('/movie/likes/{comment_id}', 'LikesController@store')->name('movie/likes');
// Route::get('/movie/likes/{comment_id}', 'LikesController@get')->name('movie/likes');
Route::post('/movie/comments/{movie_id}', 'CommentsController@store')->name('movie/comments');
Route::post('/movie/notes/{movie_id}', 'NotesController@store')->name('movie/notes');

Route::get('/account', 'AccountController@historic')->middleware('verified');
Route::post('/account', 'AccountController@update_avatar')->middleware('verified');
Route::get('/user/{id}', 'AccountController@historicGuest')->name('user');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');
