<?php

class OperateSystem extends Eloquent {

	// Add your validation rules here
	public static $rules = [
	 	'name' => 'required|unique:operate-systems',
	];

	public static $messages = [
    	'name.required' => 'Hãy nhập tên hệ điều hành',
    	'name.unique'=>'Tên hệ điều hành đã tồn tại'
	];
	// Don't forget to fill this array
	protected $fillable = ['id','name'];

	public $table = 'operate_systems';
}