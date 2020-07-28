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

Auth::routes();

Route::get('/', function () {
    if(Auth::check()){
        return redirect('pages');
    }else{
        return redirect('login');
    }
});

/**
 * Pages
 */
Route::middleware('auth')->group(function(){
    Route::get('pages','PageController@index')->name('pages');
    Route::resource('page','PageController');
});
