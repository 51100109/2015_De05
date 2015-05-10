<?php

class UserAccount extends Eloquent {

	public static $rules_create = [
	 	'username' => 'required|unique:user_accounts|min:3',
	 	'password' => 'required|min:6',
	 	'email' => 'required|unique:user_accounts',
	 	'admin'=> 'required',
	 	'fullname'=> 'required',
	 	'creenname'=> 'required',
	 	'gender'=> 'required',
	 	'birthday'=> 'required',
	 	'address'=> 'required',
	 	'phone'=> 'required'
	];

	public static $rules_edit = [
	 	'admin'=> 'required',
	];

	public static $rules_edit_admin = [
	 	'username' => 'required|min:3',
	 	'password' => 'required|min:6',
	 	'email' => 'required',
	 	'admin'=> 'required',
	 	'fullname'=> 'required',
	 	'creenname'=> 'required',
	 	'gender'=> 'required',
	 	'birthday'=> 'required',
	 	'address'=> 'required',
	 	'phone'=> 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','username','password','admin','fullname','creenname','gender','email','birthday','address','phone'];
	
	public $table="user_accounts";
}