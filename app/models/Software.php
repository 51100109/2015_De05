<?php
use Nicolaslopezj\Searchable\SearchableTrait;


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
	
	use SearchableTrait;
	
	/**
	 * Searchable rules.
	 *
	 * @var array
	 */
	protected $searchable = [
			'columns' => [
					'name' => 10,
					'description' => 2,
			],
	];

	// Don't forget to fill this array
	protected $fillable = ['id','name','image','description','filesize','language','license','download','id_category','id_system','id_publisher'];


	public $table = 'softwares';

	public static function count($id_system,$id_category){
		return Software::where('id_system','=',$id_system)->where('id_category','=',$id_category)->count();
	}

}