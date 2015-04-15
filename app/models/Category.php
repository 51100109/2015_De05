<?php

class Category extends Eloquent {

	// Add your validation rules here
	public static $rules = [
	 	'name' => 'required|unique:categories',
	];


	public static $messages = [
    	'name.required' => 'Hãy nhập tên danh mục phần mềm',
    	'name.unique'=>'Tên danh mục phần mềm đã tồn tại'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name'];
	
	public $table = 'categories';

}