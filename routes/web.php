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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Users
Route::get('/users/index' , 'UsersProfileController@index')->name('users.index');
Route::patch('/users/{user}' , 'UsersProfileController@update')->name('users.update');

//DblpPublications
Route::post('/dblp/store' , 'DblpController')->name("dblp.store");
Route::get('/dblp/authors/{name}/{last_name}' , 'DblpAuthorController@index')->name('dblp.authors.index');

//Publications
Route::get('/publications/{publication}' , 'PublicationController@show')->name('publications.show');
Route::get('/publications/{publication}/edit' , 'PublicationController@edit')->name('publications.edit');
Route::get('/publications/{type}/{value}' , 'PublicationController@filter')->name('publications.filter');
Route::patch('/publications/{publication}' , 'PublicationController@update')->name('publications.update');

//Multimedia
Route::post('/multimedias' , 'MultimediaController@store')->name('multimedias.store');
Route::delete('/multimedias/{multimedia}' , 'MultimediaController@destroy')->name('multimedias.destroy');

//Authors
Route::get('/author/show/{author}' , 'AuthorController@show')->name('authors.show');

//Topics
Route::get('/topics/{publication}/get' , 'TopicController@get')->name('topics.get');
Route::get('/topics/index' , 'TopicController@index')->name('topics.index');

//Search
Route::get('/search/autocomplete/users/{query}' , 'SearchController@autoCompleteUsers');
Route::get('/search/autocomplete/topics/{query}' , 'SearchController@autoCompleteTopics');
Route::get('/search/autocomplete/publications/{query}' , 'SearchController@autoCompletePublications');
Route::get('/search/{value}' , 'SearchController@index')->name('search.index');
Route::get('/search/users/{value}' , 'SearchController@indexUsers')->name('search.index.users');
Route::get('/search/publications/{value}' , 'SearchController@indexPublications')->name('search.index.publications');




