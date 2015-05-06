<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//---------------Frontend Group-------------------------------------

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHome'));

Route::get('login', array('as' => 'login', 'uses' => 'HomeController@showLoginPage'))->before('guest');

Route::post('login', 'AuthController@doLogin');

Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@doLogout'))->before('auth');

Route::get('profile', array('as' => 'profile', 'uses' => 'HomeController@showProfilePage'))->before('auth');

Route::get('register',array('as' => 'register', 'uses' => 'HomeController@showRegisterPage'))->before('guest');

Route::post('register_action', 'AuthController@storeRegisterInfo');

// Category view
Route::model('category', 'Category');

Route::get('category/{category}', array('as' => 'category/{category}', 'uses' => 'HomeController@showCategory'));
//--------------------------------


//view software
Route::model('software', 'Software');

Route::get('software/{software}', array('as' => 'software/{software}', 'uses' => 'HomeController@showSoftware'));
//--------------------------------

// Comment action
Route::post('comment', 'ActionController@saveComment')->before('auth');

Route::model('comment', 'Comment');

//delete comment
Route::get('comment/{comment}',array('as' => 'comment/{comment}', 'uses' => 'ActionController@deleteComment') )->before('auth');
//--------------------------------

// Post -----------------------------------
Route::get('post', array('as' => 'post', 'uses' => 'HomeController@showpostList'));

Route::get('post/new', array('as' => 'post/new', 'uses' => 'HomeController@showNewpostPage'))->before('auth');

Route::post('post/new', 'ActionController@savePost')->before('auth');

Route::model('post', 'Post');

Route::get('post/{post}',array('as' => 'post/{post}', 'uses' => 'HomeController@showPost') );

Route::get('post/edit/{post}', array('as' => 'post/edit/{post}', 'uses' => 'HomeController@showEditpostPage'))->before('auth');

Route::post('post/edit/{post}','ActionController@saveEditPost')->before('auth');

Route::get('post/delete/{post}','ActionController@deletePost')->before('auth');

//---------------Backend Group--------------------------------------------------
Route::group(array("prefix"=>"admin"),function(){

	Route::controller('activities', 'UserActivitiesController');

	Route::controller('operate-systems', 'OperateSystemsController');

	Route::controller('publishers', 'PublishersController');

	Route::controller('categories', 'CategoriesController');

	Route::controller('user-accounts', 'UserAccountsController');

	Route::controller('posts', 'PostsController');

	Route::controller('comments', 'CommentsController');

	Route::controller('softwares', 'SoftwaresController');
	
});

Route::controller('admin', 'AdminsController');
