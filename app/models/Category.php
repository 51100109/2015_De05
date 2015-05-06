<?php

class Category extends Eloquent {

	// Add your validation rules here
	// Add your validation rules here
	public static $rules = [
	 	'name' => 'required|unique:categories',
	 	'image' => 'required',
	];

	public static $rules_edit = [
	 	'image' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name','image'];
	
	public $table = 'categories';

}