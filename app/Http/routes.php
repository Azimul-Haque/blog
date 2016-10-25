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

// Authentication routes
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Reset password
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

Route::get('/article/{slug}', ['as' => 'blog.single', 'uses'=>'BlogController@getSingle']);
			//->where('slug', '[\p{Bengali}]{0,100}$/u+');
Route::get('/', 'PagesController@getIndex');
Route::get('about', 'PagesController@getAbout');
Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');
Route::get('profile/{author}', ['as' => 'pages.author', 'uses'=>'PagesController@getAuthor']);

Route::get('categories/blogs', 'PagesController@getCategoryBased');
Route::get('tag/{name}', 'PagesController@getCategoryTags');
Route::get('category/{name}', 'PagesController@getCategoryCategories');
Route::get('profile', 'PostController@getProfile');

// Post controller
Route::resource('posts', 'PostController');

// Category controller
Route::resource('categories', 'CategoryController', ['except' => 'create']);

// Tag controller
Route::resource('tags', 'TagController', ['except' => 'create']);

// Comments controller
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
// Super Admin will have these access
//Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
//Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
//Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);
//Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/report', ['uses' => 'CommentsController@report', 'as' => 'comments.report']);
Route::put('comments/{id}', ['uses' => 'CommentsController@reportconfirm', 'as' => 'comments.reportconfirm']);

// Super Admin 


Route::get('superadmin/bloggers', ['uses' => 'PostController@getBloggersList', 'as' => 'posts.bloggerlist']);

