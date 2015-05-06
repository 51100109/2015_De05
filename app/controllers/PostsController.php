<?php

class PostsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.posts.index', compact('system'));
	}

	public function postDetroyId($id,$back){
		$post = Post::findOrFail($id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Bài đăng', $post->id,"Tiêu đề: ".$post->title);
		Session::put('success',"Đã xóa bài đăng có ID: ".$post->id);
		Post::destroy($id);
		$find = Post::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			if(!empty($find))
				return Redirect::to("admin/posts/information/{$find->id}");
			else
				return View::make('backend.modals.null', ['item'=>"bài đăng"]);
		}
	}

	public function postDetroy(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn bài đăng cần xóa");
			return Redirect::back();
		}
		else{
			foreach ($id as $key) {
				$post = Post::findOrFail($key);
				UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Bài đăng', $post->id,"Tiêu đề: ".$post->title);
				Post::destroy($key);
			}
			Session::put('success',"Đã xóa các bài đăng vừa chọn");
			return Redirect::back();
		}
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
                          ->edit_column('title', '{{{ Str::limit($title, 40, \'...\') }}}')
                          ->edit_column(
                          		'username', 
                          		' 	@if(!empty($id_user))
					                    <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 20, \'...\') }}}</a>
					             	@else
					                    [ ... ]
					             	@endif 
                          		')
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',8)	                      
       					  ->remove_column('id_user')
       					  ->remove_column('admin')
       					  ->remove_column('gender')
		                  ->make();
    }

}

