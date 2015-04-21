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
		
		Comment::saveData($data);
		UserActivity::addActivity(Input::get('id_user'), 1,3,Input::get('id_target'),Input::get('content'));
		
	}
	
	public function deleteComment($comment)
	{
		if (Auth::check())
		{
			$idUser = Auth::user()->id;
			if ($idUser == $comment->id_user)
			{
				$comment->delete();
			}
			return "No permission";
		}
		else
		{
			return "Denied";
		}
	}
}
