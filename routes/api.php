<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Api', 'as' => 'api.' ], function () {

 
        Route::get('/parameter_search', 'MainController@all')->name('more');
        
        Route::get('/v1/orders/one/{id}', 'ChatController@one')->name('one.order');
        Route::post('/v1/messages/create', 'ChatController@create')->name('message.create');


        
});
