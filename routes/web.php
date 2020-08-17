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
        return view('main.auth.home');
    }else{
        return view('main.ano.home');
    }

})->name('home');

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

    /**
     * Page route
     */
    Route::resource('page','PageController');
    Route::get('page/{id}/destroy','PageController@destroy')->name('page.destroy.fix');


    /**
     * Collection route
     */

    Route::resource('collection','CollectionController');
    Route::get('collection/{id}/destroy','CollectionController@destroy')->name('collection.destroy.fix');

    /**
     * CollectionPage route
     */
    Route::get('collection/{id}/addPages','CollectionPageController@add')->name('collection.addPages');
    Route::post('collection/{id}/storePages','CollectionPageController@store')->name('collection.storePages');
    Route::post('collection/{id}/deletePages','CollectionPageController@destroy')->name('collection.deletePages');

    /**
     * Profil
     */
    Route::get('/profil', 'ProfilController@index')->name('profil.index');
    Route::put('/profil/{id}/update', 'ProfilController@update')->name('profil.update');
    Route::get('/profil/group/{id}/exit', 'UserGroupController@destroy')->name('userGroup.destroy');
    Route::get('/profil/friend/{id}/destroy', 'FriendController@destroy')->name('friend.destroy');
    Route::get('/profil/friend/{id}/add', 'FriendController@add')->name('friend.add');
    Route::get('/profil/friend/{id}/request', 'FriendController@request')->name('friend.request');


    /**
     * Groupe
     */
    Route::get('group', 'GroupController@index')->name('group.index');
    Route::get('/group/create', 'GroupController@create')->name('group.create');
    Route::post('/group/store', 'GroupController@store')->name('group.store');
    Route::get('/group/{id}/exit', 'GroupController@exit')->name('group.exit');

    Route::get('/group/{id}/edit', 'GroupController@edit')->name('group.edit');
    Route::get('/group/{id}/share', 'GroupController@share')->name('group.share');
    Route::get('/group/{id}/show', 'GroupController@show')->name('group.show');
    Route::put('/group/{id}/update', 'GroupController@update')->name('group.update');
    Route::get('/group/{id}/destroy', 'GroupController@destroy')->name('group.destroy');
    Route::get('/group/{id}/kick/{user_id}', 'GroupController@kick')->name('group.kick');

    /**
     * Share
     */

    Route::get('/share/indexPage','ShareGroupController@indexPage')->name('share.indexPage');
    Route::post('/share/{id}/page','ShareGroupController@sharePage')->name('share.page');

    /**
     * Group policies
     */
    Route::get('/share/{id}/page/policies/{page}', 'ShareGroupPoliciesController@edit')->name('policies.edit');
    Route::post('/share/{id}/page/policies/{page}/store/{member}', 'ShareGroupPoliciesController@store')->name('policies.store');

    /**
     * Inbox
     */
    Route::get('inbox', 'InboxController@index')->name('inbox.index');
    Route::get('/inbox/{id}/toTrash', 'InboxController@toTrash')->name('inbox.toTrash');

    Route::get('/inbox/{id}/destroy', 'NotificationController@destroy')->name('notification.destroy');


    /**
     * gridstack
     */
    Route::get('/gridstack', function (){
        return view('page.gridstack');
    });

});





