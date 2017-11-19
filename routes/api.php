<?php

use Illuminate\Http\Request;
use Illuminate\Encryption;
use Illuminate\Session\Middleware\StartSession;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('genre/create', 'GenreController@store');
Route::post('genre/update/{id}', 'GenreController@update');
Route::get('genre/all', 'GenreController@index');
Route::get('genre/{id}', 'GenreController@index');
Route::delete('genre/delete/{id}', 'GenreController@destroy');

Route::post('film/create', 'FilmController@store');
Route::post('film/comment/create', 'CommentController@store');



