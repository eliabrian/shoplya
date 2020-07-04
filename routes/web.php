<?php

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function ()
{ 
    Route::prefix('api')->group(function () {
        //Lists Routes
        Route::resource('lists', 'api\ListsController');

        //Items Routes
        Route::get('lists/{list}/items', 'api\ItemsController@index');
        Route::post('/items', 'api\ItemsController@store');
        Route::delete('/items/{item:id}', 'api\ItemsController@destroy');
        Route::put('/items/{item:id}/complete', 'api\ItemsController@complete');
    });

    Route::get('/{any}', function () {
        return view('layouts.app');
    })->where('any', '.*');
});