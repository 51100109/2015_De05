<?php

class Publisher extends Eloquent {

	// Add your validation rules here
	public static $rules = [
	 	'name' => 'required|unique:publishers',
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name'];
	
	public $table = 'publishers';
}