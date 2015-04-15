<?php

class Software extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name','image','description','filesize','language','license','download','id_category','id_system','id_publisher'];

	public $table = 'softwares';

}