<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

// 	public function showWelcome()
// 	{
// 		return View::make('hello');
// 	}

	public function showHome()
	{
		return View::make('home');
	}
	
	public function showLoginPage()
	{
		return View::make('login');
	}
	
	public function  showProfilePage()
	{
		return View::make('profile');
	}
	
	public function doLogin()
	{
		$user = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
		);
		
		if (Auth::attempt($user)) {
			return Redirect::route('home')
			->with('flash_notice', 'You are successfully logged in.');
		}
		
		// authentication failure! lets go back to the login page
		return Redirect::route('login')
		->with('flash_error', 'Your username/password combination was incorrect.')
		->withInput();
	}
	
	public function  doLogout()
	{
		Auth::logout();
		
		return Redirect::route('home')
		->with('flash_notice', 'You are successfully logged out.');
	}
}
