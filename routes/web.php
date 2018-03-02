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


Route::get('/', function (){
    return redirect('/movies');
});

Route::get('/movies', 'MovieController@index')->name('movies');

Auth::routes();



Route::group(['middleware'=>['auth']], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/bestellen', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['collaborator'], 'prefix' => '/admin'], function (){
        // localhost:8000/admin/

        // url for this item below is (localhost:8000/admin/movies/{id}/edit)
        Route::get('/movies/{movie}/edit', 'MovieController@edit');
        Route::post('/movies/{movie}/edit', 'MovieController@update');
    });
});