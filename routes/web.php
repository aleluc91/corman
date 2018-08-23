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

//Users
Route::get('/users/index' , 'UsersProfileController@index')->name('users.index');
Route::patch('/users/{user}' , 'UsersProfileController@update')->name('users.update');

//DblpPublications
Route::post('/dblp/store' , 'DblpPublicationController')->name("dblp.store");


//Publications
Route::get('/publications/show/{publication}' , 'PublicationController@show')->name('publications.show');
Route::get('/publications/{publication}/edit' , 'PublicationController@edit')->name('publications.edit');