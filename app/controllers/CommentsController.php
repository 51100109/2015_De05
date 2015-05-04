<?php

class CommentsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		return View::make('backend.comments.index');
	}

	public function postDetroyId($id,$back){
		$comment = Comment::findOrFail($id);
		UserActivity::addActivity(Session::get('user'), 'Xóa', 'Bình luận', $comment->id,"Nội dung: ".$comment->content);
		Session::put('success',"Đã xóa bình luận có ID: ".$comment->id);
		Comment::destroy($id);
		$find = Comment::get()->first();
		if($back == 'back')
			return Redirect::back();
		else if($back=='next'){
			return Redirect::to("admin/comments/information/{$find->id}");
		}
	}

	public function postDetroy(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn bình luận cần xóa");
			return Redirect::back();
		}
		else{
			foreach ($id as $key) {
				$comment = Comment::findOrFail($key);
				UserActivity::addActivity(Session::get('user'), 'Xóa', 'Bình luận', $comment->id,"Nội dung: ".$comment->content);
				Comment::destroy($key);
			}
			Session::put('success',"Đã xóa các bình luận vừa chọn");
			return Redirect::back();
		}
	}

	public function getInformation($id){
		$show = Comment::findOrFail($id);
		return View::make('backend.comments.show',compact('show'));
	}

	public function getData(){
    	 $comments = Comment::leftjoin('user_accounts', 'user_accounts.id', '=','comments.id_user')
    	 					->select(array('comments.id as id', 'user_accounts.id as id_user', 'user_accounts.admin as admin', 'user_accounts.gender as gender','comments.content as content', 'user_accounts.username as username', 'comments.created_at'));

		return  Datatables::of($comments)					  
                          ->add_column(
                          		'infor', 
                          		'<a href="{{{ URL::to(\'admin/comments/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
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
                          ->edit_column('content', '{{{ Str::limit($content, 40, \'...\') }}}')
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

    public function getDataHidden(){
    	$comments = Comment::select(array('comments.id as id','comments.content as content'));
		return  Datatables::of($comments)					  
                          ->edit_column('id', '<a href="{{{ URL::to(\'admin/comments/information/\' . $id) }}}" class="show_info_hidden close block em1_1" style="float:left">{{ $id }}</a>')	                      
                          ->edit_column('content', '{{{ Str::limit($content, 20, \'...\') }}}')
                          ->add_column(
                          		'delete', 
                          		'	<form method="POST" action="{{{ URL::to(\'admin/comments/detroy-id/\' . $id . \'/back\') }}}" style="display:inline">
										<a class="close delete em1_1" data-toggle="modal" href="#confirmDelete" data-title="Xóa bình luận" data-message="Bạn chắc chắn muốn xóa bình luận có ID: {{ $id }} ?"><span class="glyphicon glyphicon-remove"></span></a>
									</form>
                          		',3)	                      
		                  ->make();
    }

 	public function getCommentItem($item, $id){
 		if($item == "posts"){
    	 	$comments = Comment::where('target','=','Bài đăng')->where('id_target','=',$id)
    	 					->leftjoin('user_accounts', 'user_accounts.id', '=','comments.id_user')
    	 					->select(array('comments.id as id', 'user_accounts.id as id_user', 'user_accounts.admin as admin', 'user_accounts.gender as gender','comments.content as content', 'user_accounts.username as username', 'comments.created_at'));
 		}
 		else if($item == "softwares"){
 			$comments = Comment::where('target','=','Phần mềm')->where('id_target','=',$id)
    	 					->leftjoin('user_accounts', 'user_accounts.id', '=','comments.id_user')
    	 					->select(array('comments.id as id', 'user_accounts.id as id_user', 'user_accounts.admin as admin', 'user_accounts.gender as gender','comments.content as content', 'user_accounts.username as username', 'comments.created_at'));

 		}

		return  Datatables::of($comments)					  
                          ->add_column(
                          		'infor', 
                          		'<a href="{{{ URL::to(\'admin/comments/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
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
                          ->edit_column('content', '{{{ Str::limit($content, 40, \'...\') }}}')
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
