<?php

class PostsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$posts = Post::paginate(10);
		$activities = UserActivity::where('target','=','Bài đăng')->orderBy("created_at","desc")->paginate(10);
		return View::make('posts.index', compact('posts','activities'));
	}


	public function getDelete($id){
		$posts = Post::paginate(10);
		$posttitle= Post::all();
		if($id != 0)
			$postcheck= Post::findOrFail($id);
		return View::make('posts.delete',compact('posts','posttitle','postcheck'));
	}

	public function postDelete(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn bài đăng cần xóa");
			return Redirect::to("posts/delete/0");
		}
		else{	
			$delete = Post::findOrFail($id);
			UserActivity::addActivity(Session::get('user'), 'Xóa', 'Bài đăng', $delete->id,$delete->title);
			Session::put('delete_success',"Đã xóa bài đăng ".$delete->title." có ID: ".$delete->id);
			Post::destroy($id);
			return Redirect::to("posts/delete/0");
		}
	}

	public function getShow(){
		$posts = Post::paginate(10);
		$posttitle= Post::all();
		return View::make('posts.show',compact('posts','posttitle'));
	}

	public function postShow(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn bài đăng cần xem thông tin");
			return Redirect::to("posts/show");
		}
		else{
			return Redirect::to("posts/information/{$id}");	
		}
	}

	public function getInformation($id){
		$show = Post::findOrFail($id);
		$posts = Post::paginate(10);
		$comments= Comment::where('target','=','Bài đăng')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		$activities = UserActivity::where('target','=','Bài đăng')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		return View::make('posts.information',compact('posts','comments','activities','show'));
	}

}

