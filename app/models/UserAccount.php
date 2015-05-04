<?php

class UserAccount extends Eloquent {

	public static $rules = [
	 	'username' => 'required|unique:user-accounts|min:3',
	 	'password' => 'required|min:6',
	 	'email' => 'required|unique:user-accounts',
	 	'admin'=> 'required',
	 	'fullname'=> 'required',
	 	'creenname'=> 'required',
	 	'gender'=> 'required',
	 	'birthday'=> 'required',
	 	'address'=> 'required',
	 	'phone'=> 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','username','admin','fullname','creenname','gender','email','birthday','address','phone'];
	

	public $table="user_accounts";
	public function post(){
		return $this->hasMany('Post','id_user');
	}

	public function comment(){
		return $this->hasMany('Comment','id_user');
	}

	public function useractivity(){
		return $this->hasMany('UserActivity','id_user');
	}

	public static function check_login($user_input,$password){
		$array1=array('user_input'=>$user_input);
		$rules=array('user_input'=>'email');
		if(Validator::make($array1,$rules)->fails()){
			$check=UserAccount::where('username','=',$user_input)->where('password','=',$password)->get()->first();
		}
		else{
			$check=UserAccount::where('email','=',$user_input)->where('password','=',$password)->get()->first();
		}
		if(!empty($check)){
			Session::put('logined', 'true');
			Session::put('admin', $check->admin);
			Session::put('user', $check->id);
			return true;
		}
		else
			return false;
	}

	public static function check_username($username){
		if(UserAccount::where('username','=',$username)->count() > 0)
			return true;
		else
			return false;
	}

	public static function check_email($email){
		if(UserAccount::where('email','=',$email)->count() > 0)
			return true;
		else
			return false;
	}
}