<?php

class Post extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','id_user','title','content'];

	public $table = 'posts';
	
	public static function savePost($idUser,$title,$content)
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date=new DateTime();
		
		$post = new Post;
	
		$post->id_user = $idUser;
		$post->title = $title;
		$post->content = $content;
		$post->created_at = $date->format("Y-m-d H:i:s");
	
		$post->save();
	
		return $post->id;
	}
	
	public static function saveEditPost($idPost,$title,$content)
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date=new DateTime();
		
		$post = Post::find($idPost);
		
		$post->title = $title;
		$post->content = $content;
		$post->updated_at = $date->format("Y-m-d H:i:s");
		
		$post->save();
	}
	
	

}