<?php

use Illuminate\Support\Facades\Route;

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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'albums',  'middleware' => 'auth'], function()
{
    Route::get('/', 'AlbumController@index')->name('album');
    Route::get('/create', 'AlbumController@create')->name('album.create');
    Route::get('/get', 'AlbumController@getAlbums');
    Route::post('/store', 'AlbumController@store');
    Route::put('/{id}/edit', 'AlbumController@update');
    Route::delete('/{id}/delete', 'AlbumController@destroy');
});

Route::group(['prefix' => 'images', 'middleware' => 'auth'], function () {
    Route::get('/{id}/upload', 'ImageController@create');
    Route::get('/{id}/view', 'ImageController@index');
    Route::post('/store', 'ImageController@store');
});
Route::get('/profile/{id}', 'UserController@show')->name('profile');
Route::resource('/follow','FollowerController')->middleware('auth');
Route::get('{id}/followers', 'FollowerController@getFollowers');
Route::get('{id}/followings', 'FollowerController@getFollowings');