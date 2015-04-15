@extends('comments.main')

@section('title')
	Bài đăng
@stop

@section('content')
	<div class="row">
		<ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li class="active"> Bài đăng</li>
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Bình Luận</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="{{asset('comments/index')}}">Bình luận</a></li>
		        <li><a href="{{asset('comments/delete/0')}}">Xóa bình luận</a></li>	   
			    <li><a href="{{asset('comments/show')}}">Thông tin bình luận</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Bình Luận</h3>
                </div>

                @if ($comments->count())
				<div class="panel-body">
					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
	                            <th>ID</th>
	                          	<th>Người Đăng</th>
	                        	<td class="border"></td>
								<td class="border"></td>
	                        </tr>
						</thead>
						<tbody>
							@foreach ($comments as $comment)
					        <tr >
					            <td >{{ $comment->id }}</td>
					            <td >
									@if(!empty( UserAccount::find($comment->id_user)))
			                    		<a href="<?php echo asset("user-accounts/information/{$comment->id_user}"); ?>" class="block"> {{ UserAccount::find($comment->id_user)->username }}</a>
			                    	@else
			                    		[ Không tồn tại ]
			                    	@endif
			                    </td>
	                            <td><a href="<?php echo asset("comments/information/{$comment->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("comments/delete/{$comment->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
	                        </tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$comments->links()}}
			        </div>
				</div>
				@else
					<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
			</div>

			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Hoạt Động Administrator</h3>
		        </div>

		        @if ($activities->count())
				<div class="panel-body">
			        <table class="table table-hover tablesorter">
			            <thead>
			                <tr>  
			                    <th>Admin</th>
			                    <th>Hoạt Động</th>
			                    <th>ID Bình Luận</th>
			                    <th>Bình Luận</th>
			                    <th>Thời Gian</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($activities as $log)
			                <tr>
			                	<td>
									@if(!empty( UserAccount::find($log->id_user)))
			                    		<a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username}}</a>
			                    	@else
			                    		[ Không tồn tại]
			                    	@endif
			                    </td>
			                    <td>{{ $log->activity }}</td>
			                    <td>
									@if(!empty(Comment::find($log->id_target)))
			                    		<a href="<?php echo asset("comments/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
			                    	@else
			                    		{{ $log->id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
			                    	@endif
			                    </td>
			                    <td>{{ $log->infor }}</td>
			                    <td>{{ $log->created_at }}</td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
			        <div class="text-right">
			            {{$activities->links()}}
			        </div>
		        </div>
		        @else
		        	<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
		    </div>
		</div>
	</div>
@stop
