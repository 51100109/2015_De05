<?php

class CommentsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.comments.index', compact('system'));
	}

	public function getCreate($target,$id_target){
		return View::make('backend.comments.create',compact('target','id_target'));
	}

	public function postCreate($target,$id_target){
		$validator = Validator::make($data = Input::all(), Comment::$rules);
		if ($validator->fails()){
			Session::put('fail',"Vui lòng nhập nội dung bình luận");
			return Redirect::back();
		}
		else{
			$comment = new Comment;
			$comment->id_user = Auth::user()->id;
			$comment->content = Input::get('content');
			if($target == "posts")
				$comment->target = "Bài đăng";
			else if($target == "softwares")
				$comment->target = "Phần mềm";
			$comment->id_target = $id_target;
			$comment->save();
			UserActivity::addActivity(Auth::user()->id, 'Thêm', 'Bình luận', $comment->id,"Bình luận: ".$comment->content."- ID: ".$comment->id);
			Session::put('success',"Đã thêm bình luận có ID: ".$comment->id);
			return Redirect::back();
		}
	}

	public function getEdit($id){
		$comment=Comment::findOrFail($id);
		return View::make('backend.comments.edit',compact('comment'));
	}

	public function postEdit($id){
		$validator = Validator::make($data = Input::all(), Comment::$rules);
		if ($validator->fails()){
			Session::put('fail',"Vui lòng nhập nội dung bình luận");
			return Redirect::back();
		}
		else{
			$comment = Comment::find($id);
			$comment->update($data);
			UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Bình luận', $comment->id,"Cập nhật bình luận ".$comment->title." có ID: ".$comment->id);
			Session::put('success',"Đã cập nhật bình luận có ID: ".$comment->id);
			return Redirect::back();
		}
	}

	public function getDelete($id){
		$comment = Comment::find($id);
		$string = Str::limit($comment->content, 150, '...');
		return View::make('backend.modals.delete_form', ['id'=>$comment->id,'title'=>"bình luận",'item'=>"comments",'content'=>$string]);
	}

	public function postDelete($id){
		$comment = Comment::find($id);
		Session::put('success',"Đã xóa bình luận có ID: ".$id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Bình luận', $comment->id,"Nội dung: ".$comment->content);
		Comment::destroy($id);
		return Redirect::to("admin/comments/index");
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
                          ->edit_column('content', '{{{ Str::limit($content, 20, \'...\') }}}')
                          ->edit_column(
                          		'username', 
                          		' 	@if(!empty($id_user))
					                    <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
					             	@else
					                    [ ... ]
					             	@endif 
                          		')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/comments/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',8)	                      
                          ->add_column('delete', '<a class="close delete delete_info_entry em1_4" href="{{{ URL::to(\'admin/comments/delete/\' . $id) }}}"><span class="glyphicon glyphicon-trash"></span></a>',9)	                      
       					  ->remove_column('id_user')
       					  ->remove_column('admin')
       					  ->remove_column('gender')
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
                          ->edit_column('content', '{{{ Str::limit($content, 20, \'...\') }}}')
                          ->edit_column(
                          		'username', 
                          		' 	@if(!empty($id_user))
					                    <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
					             	@else
					                    [ ... ]
					             	@endif 
                          		')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/comments/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',8)	                      
                          ->add_column('delete', '<a class="close delete delete_info_entry em1_4" href="{{{ URL::to(\'admin/comments/delete/\' . $id) }}}"><span class="glyphicon glyphicon-trash"></span></a>',9)	                      
       					  ->remove_column('id_user')
       					  ->remove_column('admin')
       					  ->remove_column('gender')
		                  ->make();
    }

}
