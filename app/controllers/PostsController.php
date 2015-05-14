<?php

class PostsController extends BaseController {

	public function __construct(){
		$this->beforeFilter('auth');
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.posts.index', compact('system'));
	}

	public function getCreate(){
		return View::make('backend.posts.create');
	}

	public function postCheckTitle(){
		if( strip_tags(Purifier::clean(Input::get('title'))) !=  Input::get('title'))
			return "false";
		else
			return "true";
	}

	public function postCreate(){
		$data = Input::all();
		$data["title"]=strip_tags(Purifier::clean($data["title"]));
		if($data["title"] != Input::get('title')){
			Session::put('fail',"Khởi tạo không thành công");
			return Redirect::back();
		}
		else{
			$validator = Validator::make($data, Post::$rules);
			if ($validator->fails()){
				Session::put('fail',"Khởi tạo không thành công");
				return Redirect::back();
			}
			else{
				$post = new Post;
				$post->id_user = Auth::user()->id;
				$post->title = $data["title"];
				$post->content = $data["content"];
				$post->save();
				UserActivity::addActivity(Auth::user()->id, 'Thêm', 'Bài đăng', $post->id,"Bài đăng ".$post->title." có ID: ".$post->id);
				Session::put('success',"Đã thêm bài đăng ".$post->title." có ID: ".$post->id);
				return Redirect::back();
			}
		}
	}

	public function getEdit($id){
		$post=Post::findOrFail($id);
		return View::make('backend.posts.edit',compact('post'));
	}

	public function postEdit($id){
		$data = Input::all();
		$data["title"]=strip_tags(Purifier::clean($data["title"]));
		if($data["title"] != Input::get('title')){
			Session::put('fail',"Cập nhật không thành công");
			return Redirect::back();
		}
		else{
			$validator = Validator::make($data, Post::$rules);
			if ($validator->fails()){
				Session::put('fail',"Vui lòng nhập nội dung bài đăng");
				return Redirect::back();
			}
			else{
				$post = Post::find($id);
				$post->title = $data["title"];
				$post->content = $data["content"];
				$post->save();
				UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Bài đăng', $post->id,"Cập nhật bài đăng ".$post->title." có ID: ".$post->id);
				Session::put('success',"Đã cập nhật bài đăng ".$post->title." có ID: ".$post->id);
				return Redirect::back();
			}
		}
	}

	public function getDelete($id){
		$post = Post::find($id);
		$string = Str::limit($post->title, 150, '...');
		return View::make('backend.modals.delete_form', ['id'=>$post->id,'title'=>"bài đăng",'item'=>"posts",'content'=>$string,'counter'=>0]);
	}

	public function postDelete($id){
		$post = Post::find($id);
		Session::put('success',"Đã xóa bài đăng có ID: ".$id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Bài đăng', $post->id,"Tiêu đề: ".$post->title);
		Post::destroy($id);
		$comments = Comment::where('target','=','Bài đăng')->where('id_target','=',$id)->get();
	    foreach ($comments as $comment) {
	        UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Bình luận', $comment->id,"Nội dung: ".$comment->content);
	        Comment::destroy($comment->id);
	    }
		return Redirect::to("admin/posts/index");
	}

	public function getInformation($id){
		$show = Post::findOrFail($id);
		$view = UserActivity::where('id_target','=',$show->id)->where('target','=','Bài đăng')->where('activity','=','Xem thông tin')->count();
		$number_comments = Comment::where('target','=','Bài đăng')->where('id_target','=',$show->id)->count();
		return View::make('backend.posts.show',compact('show','view','number_comments'));
	}

	public function getData(){
    	 $posts = Post::leftjoin('user_accounts', 'user_accounts.id', '=','posts.id_user')
    	 					->select(array('posts.id as id', 'user_accounts.id as id_user', 'user_accounts.admin as admin', 'user_accounts.gender as gender','posts.title as title', 'user_accounts.username as username', 'posts.created_at'));

		return  Datatables::of($posts)					  
                          ->add_column(
                          		'infor', 
                          		'<a href="{{{ URL::to(\'admin/posts/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
										@if(!empty($id_user))
						                    @if($gender == "Nam")
												<img src="{{asset(\'assets/image/comments/male_comment.png\')}}" class="size40" alt="{{ $id }}">
						                    @else
												<img src="{{asset(\'assets/image/comments/female_comment.png\')}}" class="size40" alt="{{ $id }}">
						                    @endif
						                @else
											<img src="{{asset(\'assets/image/comments/user_comment.png\')}}" class="size40" alt="{{ $id }}">
						                @endif
                          		</a>',0)	                      
                          ->edit_column('title', '{{{ Str::limit($title, 20, \'...\') }}}')
                          ->edit_column(
                          		'username', 
                          		' 	@if(!empty($id_user))
					                    <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
					             	@else
					                    [ ... ]
					             	@endif 
                          		')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/posts/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',8)	                      
                          ->add_column('delete', '<a class="close delete delete_info_entry em1_4" href="{{{ URL::to(\'admin/posts/delete/\' . $id) }}}"><span class="glyphicon glyphicon-trash"></span></a>',9)	                      
       					  ->remove_column('id_user')
       					  ->remove_column('admin')
       					  ->remove_column('gender')
		                  ->make();
    }

}

