<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_accounts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	public static function saveFormData($data)
	{
		DB::table('user_accounts')->insert($data);
	}
	
	public static function updatePassword($userid,$pass)
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date=new DateTime();
		 
		$user = User::find($userid);
		$user->password = $pass;
		$user->updated_at=$date->format("Y-m-d H:i:s");
		$user->save();
	}

}
