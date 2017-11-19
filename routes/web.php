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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('genre/create', function () {
    return view('create-genre');
})->name("genre")->middleware("auth:web");

Route::middleware("auth:web")->get('films/create', 'FilmController@create')->name("newfilm");
Route::get('films', 'FilmController@index')->name("films");
Route::get('films/{slug}', ['as' => 'films.show', 'uses' => 'FilmController@show']);


