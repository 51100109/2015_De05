<?php

class UserController extends BaseController{

	public function __construct(){
    	$this->beforeFilter('check-login', array('only' => array('getEditProfile')));
	}

	public function postCheckUsername(){
		if(!UserAccount::check_username(Input::get('username')))
			return "true";
		else
			return "false";
	}
	
	 public function postCheckEmail(){
        if(!UserAccount::check_email(Input::get('email')))
			return "true";
		else
			return "false";
       }

    public function getRegister(){
    	return View::make('register.register');
    }

    public function postRegister(){
    	$rules=array(
		'username'=>'required|min:6',
		'password'=>'required|min:6',
		'email'=>'required|email');
		if(!Validator::make(Input::all(),$rules)->fails()){
			if(!UserAccount::check_username(Input::get('username')) && !UserAccount::check_email(Input::get('email'))){
				$user=new UserAccount();
				$user->username=Input::get('username');
				$user->password=Input::get('password');
				$user->email=Input::get('email');
				$user->gender=Input::get('gender');
				$user->save();
				Session::put('register_success',Input::get('username')." đã đăng ký thành công");
				return Redirect::to("user/login");
			}
		}
    }
	
	public function getLogin(){
		return View::make('register.login');
	}

	public function postLogin(){
		if(UserAccount::check_login(Input::get('user_input'),Input::get('password'))){
			if(Session::get('admin')==0){
	            return Redirect::to('/');
	        }  
	        else if (Session::get('admin')==1) {
	            return Redirect::to("admin/home");
	       	}
		}
		else
			return View::make('register.login')->with("error_message",'Tên đăng nhập hoặc mật khẩu không đúng');
	}

	public function getEditProfile(){
		return View::make('register.edit-profile');
	}

	public function getLogout(){
		Session::clear();
		return Redirect::to("user/login");
	}
}
