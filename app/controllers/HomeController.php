<?php

class HomeController extends BaseController {

	public static $itemPerPage = 15;
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
			$posts = Post::orderBy('updated_at', 'DESC')->paginate(HomeController::$itemPerPage);		
			$softwares = Software::orderBy('updated_at', 'DESC')->paginate(HomeController::$itemPerPage);
			return View::make('front.views.home',['softwares'=>$softwares,'posts'=>$posts]);
		}
		
	public function showpostSoftware()
	{
		$softwares = Software::orderBy('updated_at', 'DESC')->paginate(HomeController::$itemPerPage);
		return View::make('front.views.softwares',['softwares'=>$softwares]);
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
		$softwares = Software::where('id_category', '=', $category->id)->orderBy('created_at', 'DESC')->paginate(HomeController::$itemPerPage);
		return View::make('front.views.category',['softwares'=>$softwares,'categoryname'=>$category->name]);
	}
	
	public function showSoftware($software)
	{
		return View::make('front.views.software',['software'=>$software]);
	}
	
	public function showNewpostPage()
	{
		return View::make('front.views.post.newpost');
	}
	
	public function showpostList()
	{
		$posts = Post::orderBy('created_at', 'DESC')->paginate(HomeController::$itemPerPage);
		return View::make('front.views.post.listpost',['posts'=>$posts]);
	}

	public function showPost($post)
	{
		return View::make('front.views.post.post',['post'=>$post]);
	}
	
	public function showEditpostPage($post)
	{
		return View::make('front.views.post.editpost',['post'=>$post]);;
	}
}
