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

Route::get('/page/create','PageController@create')->name('page.create');
Route::post('/page/store','PageController@store')->name('page.store');
