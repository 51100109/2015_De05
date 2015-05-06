<?php

class UserActivity extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public $table = 'user_activities';

	public static  function addActivity($id_user, $activity,$target,$id_target,$infor){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date=new DateTime();
     
        $ac = new UserActivity();
        $ac->id_user=$id_user;
        $ac->activity=$activity;
        $ac->target=$target;
        $ac->id_target=$id_target;
        $ac->infor=$infor;
        $ac->created_at=$date->format("Y-m-d H:i:s");
        $ac->save();
    }

}