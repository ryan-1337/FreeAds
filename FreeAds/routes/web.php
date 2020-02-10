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
//     return view('welcome');
// });

Route::get('/', 'IndexController@showIndex');

// ============================================ PROFIL ==========================================================

Route::get('/profil/{user}', 'UserController@show')->name('Profil');
Route::get('/profil/edit/{user}', 'UserController@edit')->name('Edit');
Route::post('/profil/edit/{user}', 'UserController@update')->name('Update');
Route::post('/profil/{user}', 'UserController@destroy')->name('Delete');

// =============================================== END PROFIL =====================================================

// ================================================== ADS ============================================================


Route::get('/ad/ads', 'AdController@index')->name('Ads');
// Route::post('/ad/ads', 'AdController@index')->name('Ads');

Route::get('/ad/new', 'AdController@create')->name('New_Ad');
Route::post('/ad/new', 'AdController@store')->name('New_Ad_Post');


Route::get('/ad/ad/{ad}', 'AdController@show')->name('Show_Ad');
Route::get('/ad/edit/{ad}', 'AdController@edit')->name('Edit_Ad');
Route::post('/ad/edit/{ad}', 'AdController@update')->name('Edit_Ad_Post');


Route::post('/ad/ad/{ad}', 'AdController@destroy')->name('Delete_Ad');
Route::post('/ad/delete/{picture}', 'PictureController@destroy')->name('Delete_Picture');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
