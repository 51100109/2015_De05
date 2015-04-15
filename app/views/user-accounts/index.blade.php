@extends('user-accounts.main')

@section('title')
	Thành viên
@stop

@section('content')
	<div class="row">
		<ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li class="active"> Thành viên</li>
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Thành Viên</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="{{asset('user-accounts/index')}}">Thành viên</a></li>
		        <li><a href="{{asset('user-accounts/create')}}">Thêm thành viên</a></li>	   
		        <li><a href="{{asset('user-accounts/delete/0')}}">Xóa thành viên</a></li>	   
			    <li><a href="{{asset('user-accounts/show')}}">Thông tin thành viên</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Thành Viên</h3>
                </div>

                @if ($users->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
	                            <th>ID</th>
	                            <th>Tài Khoản</th>
	                            <th>Admin</th>
	                            <th>Tên Thành Viên</th>
	                            <th>Tên Hiển Thị</th>
	                            <th>Giới Tính</th>
	                            <td class="border"></td>
	                            <td class="border"></td>
	                        </tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
					        <tr >
					            <td>{{ $user->id }}</td>
								<td>{{ $user->username }}</td>							
	                            <td>
	                            	@if($user->admin == 1)
										<span class="glyphicon glyphicon-ok"></span>
	                            	@else
										<span class="glyphicon glyphicon-minus"></span>
	                            	@endif
	                            </td>
	                            <td>{{ $user->fullname }}</td>
	                            <td>{{ $user->creenname }}</td>
	                            <td>{{ $user->gender }}</td>
	                            <td><a href="<?php echo asset("user-accounts/information/{$user->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
	                            <td><a href="<?php echo asset("user-accounts/delete/{$user->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
	                        </tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$users->links()}}
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

		        @if ($admin_activities->count())
				<div class="panel-body">
			        <table class="table table-hover tablesorter">
			            <thead>
			                <tr>  
			                    <th>Admin</th>
			                    <th>Hoạt Động</th>
			                    <th>ID</th>
			                    <th>Tài Khoản</th>
			                    <th>Thời Gian</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($admin_activities as $log)
			                <tr>
			                    <td>
			                    	@if(!empty( UserAccount::find($log->id_user)))
			                    		<a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username}}</a>
			                    	@else
			                    		[ Không tồn tại]
			                    	@endif
			                    </td>
			                    <td>{{ $log->activity }}</td>
			                    <td>{{ $log->id_target }}</td>
			                    <td>{{ $log->infor }}</td>
			                    <td>{{ $log->created_at }}</td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
			        <div class="text-right">
			            {{$admin_activities->links()}}
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
		            <h3 class="panel-title">Hoạt Động Thành Viên</h3>
		        </div>

		        @if ($user_activities->count())
				<div class="panel-body">
			        <table class="table table-hover tablesorter">
			            <thead>
			                <tr>   
			                    <th>Member</th>
			                    <th>Hoạt Động</th>
			                    <th>Đối Tượng</th>
			                    <th>ID</th>
			                    <th>Thông tin</th>
			                    <th>Thời Gian</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($user_activities as $log)
			                <tr>
			                    <td>
			                    	@if(!empty( UserAccount::find($log->id_user)))
			                    		<a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username}}</a>
			                    	@else
			                    		[ Không tồn tại]
			                    	@endif
			                    </td>
			                    <td>{{ $log->activity }}</td>
			                    <td>{{ $log->target }}</td>
			                    <td>{{ $log->id_target }}</td>
			                    <td>{{ $log->infor }}</td>
			                    <td>{{ $log->created_at }}</td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
			        <div class="text-right">
			            {{$user_activities->links()}}
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
