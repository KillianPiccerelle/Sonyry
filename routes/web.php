<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    if(Auth::check()){
        return redirect('home');
    }else{
        return redirect('login');
    }

});

Auth::routes();

Route::get('/logout', function() {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
});


/**
 * Pages
 */

Route::middleware('auth')->group(function(){
    /**
     * Nécessite l'authentification
     * Le Route::ressource gère toutes les routes présentes dans un controller
     */
    Route::get('pages','PageController@index')->name('pages');
    Route::resource('page','PageController');

    Route::get('pages','PageController@index')->name('collections');
    Route::resource('collection','CollectionController');
});

