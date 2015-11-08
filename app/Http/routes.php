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


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('languages/create-word/{id}', 'WordsController@createForLanguage');
Route::get('languages/create-tag/{id}', 'TagsController@createForLanguage');
Route::resource('languages', 'LanguagesController');
Route::post('languages/search', 'LanguagesController@search');
Route::get('words/create-definition/{id}', 'DefinitionsController@createForWord');
Route::resource('words', 'WordsController');
Route::resource('descriptions', 'DescriptionsController');
Route::resource('definitions', 'DefinitionsController');
Route::resource('tags', 'TagsController');

Route::get('/', function () {
    $languages = \App\Language::all();
    return view('pages.home', compact('languages'));
});

Route::get('/home', function () {
    $languages = \App\Language::all();
    return view('pages.home', compact('languages'));
});