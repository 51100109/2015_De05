@extends('posts.main')

@section('title')
	Bài đăng
@stop

@section('content')
	<div class="row">
		<ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li class="active"> Bài đăng</li>
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Bài Đăng</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="{{asset('posts/index')}}">Bài đăng</a></li>
		        <li><a href="{{asset('posts/delete/0')}}">Xóa bài đăng</a></li>	   
			    <li><a href="{{asset('posts/show')}}">Thông tin bài đăng</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Bài Đăng</h3>
                </div>

                @if ($posts->count())
				<div class="panel-body">
					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
	                            <th>ID</th>
	                            <th>Tiêu Đề</th>
	                          	<th>Người Đăng</th>
	                        	<td class="border"></td>
								<td class="border"></td>
	                        </tr>
						</thead>
						<tbody>
							@foreach ($posts as $post)
					        <tr >
					            <td>{{ $post->id }}</td>
					            <td>{{ $post->title }}</td>
					            <td>
									@if(!empty( UserAccount::find($post->id_user)))
			                    		<a href="<?php echo asset("user-accounts/information/{$post->id_user}"); ?>" class="block"> {{ UserAccount::find($post->id_user)->username }}</a>
			                    	@else
			                    		[ Không tồn tại ]
			                    	@endif
			                    </td>
	                            <td><a href="<?php echo asset("posts/information/{$post->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("posts/delete/{$post->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
	                        </tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$posts->links()}}
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
		            <h3 class="panel-title">Hoạt Động Gần Đây</h3>
		        </div>

		        @if ($activities->count())
				<div class="panel-body">
			        <table class="table table-hover tablesorter">
			            <thead>
			                <tr>   
			                    <th>Thành viên</th>
			                    <th>Hoạt Động</th>
			                    <th>ID Bài Đăng</th>
			                    <th>Bài đăng</th>
			                    <th>Thời Gian</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($activities as $log)
			                <tr>
			                	<td>
									@if(!empty( UserAccount::find($log->id_user)))
			                    		<a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username }}</a>
			                    	@else
			                    		[ Không tồn tại ]
			                    	@endif
			                    </td>
			                    <td>{{ $log->activity }}</td>
			                    <td>
									@if(!empty(Post::find($log->id_target)))
			                    		<a href="<?php echo asset("posts/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
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
