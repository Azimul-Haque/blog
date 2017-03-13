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
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');

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
Route::get('profile', ['uses' => 'PostController@getProfile', 'as' => 'posts.profile']);
Route::get('bloggers/list', ['uses' => 'PagesController@getAllBloggersAtHomePage', 'as' => 'bloggers.list']);


// Post controller
Route::resource('posts', 'PostController');
Route::get('drafts', ['uses' => 'PostController@getDrafts', 'as' => 'posts.getDrafts']);

// Category controller
Route::resource('categories', 'CategoryController', ['except' => 'create']);

// Tag controller
Route::resource('tags', 'TagController', ['except' => 'create']);

// Comments controller
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);



// Super Admin will have these access
//Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
//Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/report', ['uses' => 'CommentsController@report', 'as' => 'comments.report']);
Route::put('comments/{id}', ['uses' => 'CommentsController@reportconfirm', 'as' => 'comments.reportconfirm']);

// Commentreply controller
Route::post('commentreplies/{comment_id}', ['uses' => 'CommentreplyController@store', 'as' => 'commentreplies.store']);
// the rest resource requesst will be used soon...
// Commentreply controller



// Super Admin 
Route::get('superadmin/bloggers', ['uses' => 'PostController@getBloggersList', 'as' => 'posts.bloggerlist']);
Route::get('superadmin/blog/allposts', ['uses' => 'PostController@getAllblogposts', 'as' => 'posts.allblogposts']);
Route::put('superadmin/article/feature/{id}', ['uses' => 'PostController@makeFeatured', 'as' => 'posts.makefeatured']);
Route::get('superadmin/comments/reported', ['uses' => 'CommentsController@getReportedComments', 'as' => 'posts.reportedComments']);

// UserController
Route::put('user/password/change/{id}', ['uses' => 'UserController@changePassword', 'as' => 'password.change']);
Route::put('profile/{id}', ['uses' => 'UserController@updateProfile', 'as' => 'posts.updateProfile']);
// Message Controller via UserController
Route::post('messages/send', ['uses' => 'UserController@sendMessage', 'as' => 'message.send']);
Route::get('messages', ['uses' => 'UserController@readMessage', 'as' => 'message.read']);

Route::post('conversation/send', ['uses' => 'UserController@sendConversationMessage', 'as' => 'conversation.send']);
Route::get('messages/conversation/{name}', ['uses' => 'UserController@getConversation', 'as' => 'conversation.read']);
// Message Controller via UserController

// Bloodbank Controller via UserController
Route::get('bloodbank', ['uses' => 'UserController@getBloodbank', 'as' => 'bloodbank.read']);
// Bloodbank Controller via UserController


// SearchController
Route::get('search', ['uses' => 'SearchController@getResult', 'as' => 'search.search']);
// SearchController

// Notification Controller via UserController
Route::get('notifications', ['uses' => 'UserController@getNotifications', 'as' => 'notifiactions.read']);
// Notification Controller via UserController

// NotificationController for admin
Route::resource('adminnotifications', 'NotificationController');
// NotificationController for admin





//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Clear Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

