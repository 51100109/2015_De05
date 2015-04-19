<?php

class AuthController extends BaseController {

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
	
	public function doLogin()
	{
		$user = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
		);
		
		$remember =Input::get('remember');
		
		$result = false;
		
		if ($remember == 1)
		{
			$result = Auth::attempt($user,true);
		}
		else {
			$result = Auth::attempt($user);
		}
		
		if ($result) {
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
	

	public function storeRegisterInfo()
	{
	$data =  Input::except(array('_token')) ;
            $rule  =  array(
                    'username'       => 'required|unique:user-accounts',
                    'email'      => 'required|email|unique:user-accounts',
                    'password'   => 'required|min:6|same:cpassword',
                    'cpassword'  => 'required|min:6'
                ) ;
 
            $message = array(
            		'cpassword.required' => 'The confirm password field is required.',
            		'cpassword.min'      => 'The confirm password must be at least 6 characters',
            		'password.same'      => 'The password and confirm password field must match.',
            );
            $validator = Validator::make($data,$rule,$message);


 
            if ($validator->fails())
            {
                    return Redirect::to('register')
                            ->withErrors($validator->messages());
            }
            else
            {
            		$insertData = Input::except(array('_token','cpassword'));
            		$insertData['password'] = Hash::make($insertData['password']);
                    User::saveFormData($insertData);
 
                    return Redirect::to('register')
                            ->with('flash_notice', 'Data inserted');;
            }
	}
}
