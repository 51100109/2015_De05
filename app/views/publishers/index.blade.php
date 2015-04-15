@extends('publishers.main')

@section('title')
	Nhà phát hành
@stop

@section('content')
	<div class="row">
		<ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li class="active"> Nhà phát hành</li>
	    </ol>
	    <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Nhà Phát Hành</h2>
	</div>
	<div class="row"> 
	 	<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="{{asset('publishers/index')}}">Nhà phát hành</a></li>
			    <li><a href="{{asset('publishers/create')}}">Thêm nhà phát hành</a></li>
				<li><a href="{{asset('publishers/edit/0')}}">Chỉnh sửa nhà phát hành</a></li>
		        <li><a href="{{asset('publishers/delete/0')}}">Xóa nhà phát hành</a></li>	   
			    <li><a href="{{asset('publishers/show')}}">Thông tin nhà phát hành</a></li>
			</ul>
			<br>

			<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Nhà Phát Hành</h3>
                </div>

                @if ($publishers->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Nhà Phát Hành</th>
								<td class="border"></td>
								<td class="border"></td>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($publishers as $publisher)
					        <tr >
					            <td>{{ $publisher->id }}</td>
								<td>{{ $publisher->name }}</td>
	                            <td><a href="<?php echo asset("publishers/information/{$publisher->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("publishers/edit/{$publisher->id}"); ?>" class="block"><span class="glyphicon glyphicon-edit"></span></a></td>
								<td><a href="<?php echo asset("publishers/delete/{$publisher->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$publishers->links()}}
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
			                    <th>Admin</th>
			                    <th>Hoạt Động</th>
			                    <th>ID</th>
			                    <th>Nhà Phát Hành</th>
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
			                    	@if(!empty(Publisher::find($log->id_target)))
			                    		<a href="<?php echo asset("publishers/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
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
