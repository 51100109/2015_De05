<?php

class Software extends Eloquent {

	public static $rules = [
		'name' => 'required',
		'image' => 'required',
		'description' => 'required',
		'filesize' => 'required',
		'language' => 'required',
		'license' => 'required',
		'download' => 'required',
		'id_category' => 'required',
		'id_system' => 'required',
		'id_publisher' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name','image','description','filesize','language','license','download','id_category','id_system','id_publisher'];


	public $table = 'softwares';

}