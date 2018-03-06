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

/*
|
| When you use ::get, you only get that function you call in. 
| With ::resource, Laravel knows all the functions and you do not have to declare them seperately.
|
*/
Route::resource('movies', 'MovieController');

Auth::routes();


Route::group(['middleware'=>['auth']], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/bestellen', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['collaborator'], 'prefix' => '/admin'], function (){
        // localhost:8000/admin/

        // url for this item below is (localhost:8000/admin/movies/{id}/edit)
        Route::get('/movies/{movie}/edit', 'MovieController@edit');
        Route::post('/movies/{movie}/edit', 'MovieController@update');
        Route::get('/ticket/create', 'TicketController@create');

        Route::group(['middleware' => ['collaborator:3']], function(){
        	Route::get('/movieupdate', 'MovieController@getData');
        });

    });
    Route::group(['middleware' => ['ticketowner']], function (){
        Route::get('/ticket/{id}/view', 'TicketController@show');
    });
});


