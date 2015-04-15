<?php

class Publisher extends Eloquent {

	// Add your validation rules here
	public static $rules = [
	 	'name' => 'required|unique:publishers',
	];


	public static $messages = [
    	'name.required' => 'Hãy nhập tên nhà phát hành',
    	'name.unique'=>'Tên nhà phát hành đã tồn tại'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name'];
	
	public $table = 'publishers';
}