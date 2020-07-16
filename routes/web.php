<?php

use Illuminate\Support\Facades\Auth;
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
    return view('main.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Pages
 */
Route::get('/pages','PageController@index')->name('page.index');
Route::get('/page/create','PageController@create')->name('page.create');
Route::post('/page/store','PageController@store')->name('page.store');
Route::get('page/{id}/edit','PageController@edit')->name('page.edit');
Route::get('page/{id}/delete','PageController@delete')->name('page.delete');
Route::put('page/{id}/update','PageController@update')->name('page.update');

/**
 * Collection
 */

Route::get('/collections','CollectionController@index')->name('collection.index');
Route::get('/collection/create','CollectionController@create')->name('collection.create');
Route::post('/collection/store','CollectionController@store')->name('collection.store');
