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
		$softwares = Software::all();
		return View::make('front.views.home',['softwares'=>$softwares]);
	}
	
	public function showLoginPage()
	{
		return View::make('front.views.login');
	}
	
	public function  showProfilePage()
	{
		return View::make('front.views.profile');
	}

	public function showRegisterPage()
	{
		return View::make('front.views.register');
	}
	
	public function showCategory($category)
	{
		$softwares = Software::where('id_category', '=', $category->id)->get();
		return View::make('front.views.category',['softwares'=>$softwares,'categoryname'=>$category->name]);
	}
	
	public function showSoftware($software)
	{
		return View::make('front.views.software',['software'=>$software]);
	}

}
