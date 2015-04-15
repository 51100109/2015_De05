@extends('comments.main')

@section('title')
	Xóa bình luận
@stop

@section('content')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li><a href="{{asset('comments/index')}}"> Bình luận</a></li>
	        @if(empty($commentcheck))
	            <li class="active"> Xóa bài đăng</li>
	        @else
	            <li><a href="{{asset('comments/delete/0')}}"> Xóa bình luận</a></li>
	            <li class="active">{{ $commentcheck->id }}</li>
	        @endif
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Bình Luận</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li><a href="{{asset('comments/index')}}">Bình luận</a></li>
		        <li class="active"><a href="{{asset('comments/delete/0')}}">Xóa bình luận</a></li>	   
			    <li><a href="{{asset('comments/show')}}">Thông tin bình luận</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Xóa Bình Luận</h3>
		        </div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <label>Điều khoản sử dụng</label>
				        <ol>
				        	<li>Chọn ID bình luận muốn xóa</li>
				        </ol>     
		        	</div>
			        <div>
			        	<form class="well" href="{{asset('posts/delete')}}" method="post"> 
							@if ($errors->any())
								<div class='alert alert-danger'>
									<ul>	
										{{ implode('', $errors->all('<li class="error">:message</li>')) }}
									</ul>
								</div>   
							@endif
							@if(Session::has('delete_success'))
					        	<div class="alert alert-success alert-dismissable">
									<label class="success"><span class="glyphicon glyphicon-ok"></span> {{Session::get('delete_success')}}</label>
									{{ Session::forget("delete_success") }}
								</div>
							@endif 
							@if(Session::has('fail'))
		                        <div class="alert alert-danger">
		                            <span class="glyphicon glyphicon-exclamation-sign" style="padding-left:40px"></span> {{Session::get('fail')}}
		                            {{ Session::forget("fail") }}
		                        </div>
		                    @endif 
						   <p>
		                        <label>ID bình luận</label>
		                        <select name='id' id='id' class='form-control'>
		                        	<option value="0">[ Chọn ID ]</option>
		                            @foreach($idcomment as $comment)
		                            <option value="{{$comment->id}}" <?php if(!empty($commentcheck)&&($comment->id == $commentcheck->id)) echo "selected='selected'"; ?>>ID: {{$comment->id}}</option>
		                            @endforeach
		                        </select>
		                    </p>
		                    <p><button class="btn btn-default">Xác nhận</button></p>
						</form>
					</div>
		        </div>
		    </div>
		</div>
	</div>
@stop