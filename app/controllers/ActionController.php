<?php

class ActionController extends BaseController {

	public function saveComment()
	{
		if (!(Auth::check()))
		{
			return "Denied";
		}
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date=new DateTime();
		
		$data = array(
				'id_user' => Input::get('id_user'),
				'content' => Input::get('content'),
				'target' => Input::get('target'),
				'id_target' => Input::get('id_target'),
				'created_at' => $date->format("Y-m-d H:i:s")
		);
		
		$cmId = Comment::saveData($data);
		UserActivity::addActivity(Input::get('id_user'), 1,3,$cmId,"postcomment");
		
	}
	
	public function deleteComment($comment)
	{
		if (Auth::check())
		{
			$idUser = Auth::user()->id;
			if ($idUser == $comment->id_user)
			{
				
				UserActivity::addActivity($idUser, 2,3,$comment->id,'delete comment');
				$comment->delete();
			}
			return "No permission";
		}
		else
		{
			return "Denied";
		}
	}
	
	
	public function savePost()
	{
		if (!(Auth::check()))
		{
			return "Denied";
		}
		
		$idUser = Auth::user()->id;
		$title = Input::get('title');
		$content = Input::get('content');
		
		$id= Post::savePost($idUser,$title,$content);
		UserActivity::addActivity($idUser, 1,2,$id,'newpost');
		
		return Redirect::route('post')
		->with('flash_notice', 'Đăng bài thành công!');
	}
	
	public function saveEditPost($post)
	{
		if (!(Auth::check()))
		{
			return "Denied";
		}
		$idUser = Auth::user()->id;
		
		if ($idUser != $post->id_user)
		{
			return "no permission";
		}
		$title = Input::get('title');
		$content = Input::get('content');
		
		$id= Post::saveEditPost($post->id,$title,$content);
		UserActivity::addActivity($idUser, 3,2,$post->id,'editpost');
		
		return Redirect::route('post')
		->with('flash_notice', 'Sửa bài thành công!');
	}
	
	public function deletePost($post)
	{
		if (!(Auth::check()))
		{
			return "Denied";
		}
		$idUser = Auth::user()->id;
		
		if ($idUser != $post->id_user)
		{
			return "no permission";
		}
		
		UserActivity::addActivity($idUser, 2,2,$post->id,'deletepost');
		$post->delete();
		
		//delete comment
		$commentlist = Comment::where('target', '=', 'Bài đăng')->where('id_target','=',$post->id)->delete();
		//----------------------
		
		return Redirect::route('post')
		->with('flash_notice', 'Xóa bài thành công!');
	}
}
