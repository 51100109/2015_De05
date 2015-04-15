<?php

class CommentsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$comments = Comment::paginate(10);
		$activities = UserActivity::where('target','=','Bình luận')->orderBy("created_at","desc")->paginate(10);
		return View::make('comments.index', compact('comments','activities'));
	}


	public function getDelete($id){
		$comments = Comment::paginate(10);
		$idcomment= Comment::all();
		if($id != 0)
			$commentcheck= Comment::findOrFail($id);
		return View::make('comments.delete',compact('comments','idcomment','commentcheck'));
	}

	public function postDelete(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn bài đăng cần xóa");
			return Redirect::to("comments/delete/0");
		}
		else{	
			$delete = Comment::findOrFail($id);
			UserActivity::addActivity(Session::get('user'), 'Xóa', 'Bình luận', $delete->id,$delete->content);
			Session::put('delete_success',"Đã xóa bình luận có ID: ".$delete->id);
			Comment::destroy($id);
			return Redirect::to("comments/delete/0");
		}
	}

	public function getShow(){
		$comments = Comment::paginate(10);
		$idcomment= Comment::all();
		return View::make('comments.show',compact('comments','idcomment'));
	}

	public function postShow(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn bài đăng cần xem thông tin");
			return Redirect::to("comments/show");
		}
		else{
			return Redirect::to("comments/information/{$id}");	
		}
	}

	public function getInformation($id){
		$show = Comment::findOrFail($id);
		$comments = Comment::paginate(10);
		$activities = UserActivity::where('target','=','Bình luận')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		return View::make('comments.information',compact('comments','activities','show'));
	}

}
