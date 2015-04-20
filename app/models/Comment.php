<?php

class Comment extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','id_user','content','target','id_target'];

	public $table = 'comments';
	
	public static function saveData($data)
	{
		DB::table('comments')->insert($data);
	}

}