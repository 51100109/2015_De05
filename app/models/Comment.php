<?php

class Comment extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		'content' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['id','id_user','content','target','id_target'];

	public $table = 'comments';
	
	public static function saveData($data)
	{
		$comment = new Comment;
		
		$comment->id_user = $data['id_user'];
		$comment->content = $data['content'];
		$comment->target = $data['target'];
		$comment->id_target = $data['id_target'];
		$comment->created_at = $data['created_at'];
		
		$comment->save();
		
		return $comment->id;
	}
}