<?php

class OperateSystem extends Eloquent {

	public static $rules = [
	 	'name' => 'required|unique:operate_systems',
	 	'image' => 'required',
	 	'id_category' => 'required',
	];

	public static $rules_edit = [
	 	'image' => 'required',
	 	'id_category' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name','image','id_category'];


	public $table = 'operate_systems';
}