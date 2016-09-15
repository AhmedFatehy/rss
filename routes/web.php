<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/',function (){
      return view('dashboard');
    })->name('dashboard');
    Route::get('settings',[ 'uses' => 'SettingsController@getSettings', 'as' => 'settings']);
    Route::post('settings',[ 'uses' => 'SettingsController@postSettings', 'as' => 'settings']);




    Route::post('categories/ajax',[ 'uses' => 'CategoriesController@ajax', 'as' => 'categories.ajax']);
    Route::get('categories/settings',[ 'uses' => 'CategoriesController@getSettings', 'as' => 'categories.settings']);
    Route::post('categories/settings',[ 'uses' => 'CategoriesController@postSettings', 'as' => 'categories.settings']);
    Route::resource('categories','CategoriesController');


    Route::post('seeds/ajax',[ 'uses' => 'SeedsController@ajax', 'as' => 'seeds.ajax']);
    Route::get('seeds/reload/{seed}',[ 'uses' => 'SeedsController@reload', 'as' => 'seeds.reload']);
    Route::get('seeds/settings',[ 'uses' => 'SeedsController@getSettings', 'as' => 'seeds.settings']);
    Route::post('seeds/settings',[ 'uses' => 'SeedsController@postSettings', 'as' => 'seeds.settings']);
    Route::resource('seeds','SeedsController');

    Route::resource('feeds','FeedsController');
    Route::get('feeds/settings',[ 'uses' => 'FeedsController@getSettings', 'as' => 'feeds.settings']);
    Route::post('feeds/settings',[ 'uses' => 'FeedsController@postSettings', 'as' => 'feeds.settings']);

});


Route::get('/',['uses' => 'IndexController@index', 'as' => 'index']);
Route::get('/post/{post}',['uses' => 'IndexController@post', 'as' => 'post']);
Route::get('/category/{category}',['uses' => 'IndexController@category', 'as' => 'category']);
Route::get('/seed/{seed}',['uses' => 'IndexController@seed', 'as' => 'seed']);

Auth::routes();

Route::get('/home', 'HomeController@index');
