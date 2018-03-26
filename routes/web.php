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


Route::get('/', function (){
    return redirect('/movies');
});

/*
|
| When you use ::get, you only get that function you call in. 
| With ::resource, Laravel knows all the functions and you do not have to declare them seperately.
|
*/

Auth::routes();
Route::get('/movies', 'MovieController@index');
Route::get('/movies/{id}', 'MovieController@show');


    
Route::group(['middleware'=>['auth']], function (){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/bestellen/{id}', 'SeatController@show')->name('order');

    Route::get('/tickets', 'TicketController@index');
    Route::post('/pay', 'PayController@store')->name('pay');
	
	Route::get('/paysuccess', 'PayController@complete')->name('paysuccess');
    // Route::get('/pay', 'PayController@store')->name('pay');

    Route::get('/barcodes', 'BarcodeScannerController@index');
    Route::post('/barcodes', 'BarcodeScannerController@check');
    
    Route::get('/price', 'changeGlobalsController@index');
    Route::post('/price', 'changeGlobalsController@store');

    Route::group(['middleware' => ['collaborator'], 'prefix' => '/admin'], function (){
        // localhost:8000/admin/

	    Route::get('/', function (){
		    return view('admin/dashboard');
	    });

        // url for this item below is (localhost:8000/admin/movies/{id}/edit)
        Route::get('/movies/{movie}/edit', 'MovieController@edit');
        Route::post('/movies/{movie}/edit', 'MovieController@update');
        Route::get('/ticket', 'TicketController@index');
        Route::get('/ticket/create', 'TicketController@create');
        Route::post('/ticket/create', 'TicketController@store');
        Route::get('/planning/create', 'PlanningController@create');
        Route::get('/planning', 'PlanningController@index');
        Route::post('/planning/create', 'PlanningController@store');

        Route::get('/selectseats', 'SeatController@showAll');
		
		Route::get('/paysuccessemployee', 'PayController@completeemployee')->name('paysuccessemployee');

        Route::group(['middleware' => ['collaborator:3']], function(){
            Route::get('/movieupdate', 'MovieController@movieAdd');
            Route::post('/movieupdate', 'MovieController@store');

        });

    });
    Route::group(['middleware' => ['ticketowner', 'tickettimeout']], function (){
        Route::get('/ticket/{id}/view', 'TicketController@show');
    });

});


