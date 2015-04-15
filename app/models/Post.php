<?php

class Post extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','id_user','title','content'];

	public $table = 'posts';

}