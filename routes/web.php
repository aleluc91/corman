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

Route::get('/', ['middleware' => 'guest' ,function () {
    return view('welcome');
}])->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Users
Route::get('/users/index' , 'UserProfileController@index')->name('users.index');
Route::get('/users/{user}' , 'UserProfileController@show')->name('users.show');
Route::get('/users/{user}/edit' , 'UserProfileController@edit')->name('users.edit');
Route::patch('/users' , 'UserProfileController@update')->name('users.update');


//ProfileImage
Route::post('/users/image/{image}' , 'UserProfileImageController@store')->name('users.profie.image.store');
Route::delete('/users/image/{image}' , 'UserProfileImageController@destroy')->name('users.profie.image.destroy');


//DblpPublications
Route::post('/dblp/store' , 'DblpController')->name("dblp.store");
Route::get('/dblp/authors/{name}/{last_name}' , 'DblpAuthorController@index')->name('dblp.authors.index');
Route::post('/dblp/authors' , 'DblpAuthorController@store')->name('dblp.authors.store');

//Publications
Route::get('/publications/create' , 'PublicationController@create')->name('publications.create');
Route::post('/publications' , 'PublicationController@store')->name('publications.store');
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
Route::get('/search/index/{value}' , 'SearchController@indexGroups')->name('search.index.groups');
Route::get('/search/groups/users/{value}/{group}' , 'SearchController@searchGroupsUsers')->name('search.groups.users');
Route::get('/search/users/{user}/{value}' , 'SearchController@searchUsers')->name('search.publications.users');

//Groups
Route::get('/groups' , 'GroupController@index')->name('groups.index');
Route::get('/groups/create' , 'GroupController@create')->name('groups.create');
Route::post('/groups' , 'GroupController@store')->name('groups.store');
Route::delete('/groups/{group}' , 'GroupController@destroy')->name('groups.destroy');
Route::get('/groups/{group}/edit' , 'GroupController@edit')->name('groups.edit');
Route::patch('/groups' , 'GroupController@update')->name('groups.update');
Route::get('/groups/{group}' , 'GroupController@show')->name('groups.show');
Route::post('/groups/users' , 'GroupController@acceptUser')->name('groups.users.store');
Route::get('/groups/{group}/user/publications' , 'GroupController@getUserPublications')->name('groups.users.publications');
Route::post('/groups/publication' , 'GroupController@storeUserPublication')->name('groups.users.store.publication');
Route::post('/groups/publications' , 'GroupController@storeAllUserPublications')->name('groups.users.store.publications');
Route::delete('/groups/{group}/{publication}' , 'GroupController@destroyUserPublication')->name('groups.users.destroy.publication');
Route::get('/groups/{group}/users' , 'GroupController@showAllUsers')->name('groups.users');
Route::patch('/groups/users/role' , 'GroupController@updateUserRole')->name('groups.users.update.role');
Route::delete('/groups/users/{user}/delete' , 'GroupController@deleteUser')->name('groups.users.destroy');


//Groups Registration Notification
Route::post('/groups/users/invitation' , 'GroupController@invitation')->name('groups.users.invitation');
Route::delete('/groups/registration/notification/{notification}' , 'GroupRegistrationNotificationController@destroy')->name('groups.registration.notification.destroy');
Route::post('/groups/user/partecipate' , 'GroupController@partecipate')->name('groups.users.partecipate');
Route::post('/groups/user/partecipate/accept', 'GroupController@acceptPartecipation')->name('groups.users.partecipate.accept');
Route::post('/groups/user/partecipate/refuse', 'GroupController@refusePartecipation')->name('groups.users.partecipate.refuse');
Route::post('/groups/user/invitation/refuse', 'GroupController@refuseInvitation')->name('groups.users.invitation.refuse');

