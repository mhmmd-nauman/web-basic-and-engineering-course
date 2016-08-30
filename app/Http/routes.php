<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/',function(){
//    return "<h1>Base Route</h>"; 
//});
//


Route::group(['middleware' => 'web'], function () {
   
   Route::get('/', 'HomeController@index');

    Route::auth();
    Route::get('/bear','bearController@getbear');
    Route::get('/picnic','bearController@getpicnic');
    Route::get('/fish','bearController@getfish');
    Route::get('/tree','bearController@gettree');
   
});
//Route::auth();
//
//Route::get('/', 'HomeController@index');
//Route::get('/bear','bearController@getbear');