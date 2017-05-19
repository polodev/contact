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

// Route::get('/', function () {
//     return view('contacts.index');
// });

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/', [
      'uses' => 'ContactController@index',
      'as' => 'home'
    ]);
  Route::get('/create', [
      'uses' => 'ContactController@create',
      'as' => 'create'
    ]);
  Route::get('/profile/{slug}', [
      'uses' => 'ContactController@show',
      'as' => 'show'
    ]);
  Route::get('/profile/{slug}/edit', [
      'uses' => 'ContactController@edit',
      'as' => 'edit'
    ]);
  Route::patch('/profile/{slug}', [
      'uses' => 'ContactController@update',
      'as' => 'update'
    ]);
  Route::delete('/profile/{slug}', [
      'uses' => 'ContactController@destroy',
      'as' => 'delete'
    ]);
  Route::post('/contact', 'ContactController@store');
});
