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

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHome'));

Route::get('login', array('as' => 'login', 'uses' => 'HomeController@showLoginPage'))->before('guest');

Route::post('login', 'HomeController@doLogin');

Route::get('logout', array('as' => 'logout', 'uses' => 'HomeController@doLogout'))->before('auth');

Route::get('profile', array('as' => 'profile', 'uses' => 'HomeController@showProfilePage'))->before('auth');
