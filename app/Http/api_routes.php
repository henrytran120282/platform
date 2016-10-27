<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::resource('generations', 'GenerationAPIController');

Route::get('administrator/generations', 'GenerationAPIController@index');
Route::post('administrator/generations', 'GenerationAPIController@store');
Route::get('administrator/generations/{generations}', 'GenerationAPIController@show');
Route::put('administrator/generations/{generations}', 'GenerationAPIController@update');
Route::patch('administrator/generations/{generations}', 'GenerationAPIController@update');
Route::delete('administrator/generations{generations}', 'GenerationAPIController@destroy');

Route::resource('generations', 'GenerationAPIController');















