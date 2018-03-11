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

Route::get('/ticket', function (){
    return redirect('/ticket');
});

/*
|
| When you use ::get, you only get that function you call in. 
| With ::resource, Laravel knows all the functions and you do not have to declare them seperately.
|
*/
Route::resource('movies', 'MovieController');
//Route::resource('ticket', 'TicketController');

Auth::routes();


Route::group(['middleware'=>['auth']], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/bestellen', 'SeatController@index')->name('order');
    Route::post('/pay', 'PayController@index')->name('pay');

    Route::group(['middleware' => ['collaborator'], 'prefix' => '/admin'], function (){
        // localhost:8000/admin/

        // url for this item below is (localhost:8000/admin/movies/{id}/edit)
        Route::get('/movies/{movie}/edit', 'MovieController@edit');
        Route::post('/movies/{movie}/edit', 'MovieController@update');
        Route::get('/ticket/create', 'TicketController@create');
        Route::post('/ticket/create', 'TicketController@store');

        Route::group(['middleware' => ['collaborator:3']], function(){
        	Route::get('/movieupdate', 'MovieController@movieAdd');
            Route::post('/movieupdate', 'MovieController@store');
        });

    });
    Route::group(['middleware' => ['ticketowner', 'tickettimeout']], function (){
        Route::get('/ticket/{id}/view', 'TicketController@show');
    });
});


