<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('corrals', 'CorralController@index');

Route::get('corrals/{corral}', 'CorralController@show');

Route::get('/', 'SheepController@index');

Route::get('sheeps/{sheep}', 'SheepController@show');

Route::post('sheep', 'SheepController@create');

Route::put('delete', 'SheepController@update');

Route::delete('sheeps/{sheep}', 'SheepController@delete');