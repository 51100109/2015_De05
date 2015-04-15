@extends('softwares.main')

@section('title')
	Phần mềm
@stop

@section('content')
	<div class="row">
		<ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li class="active"> Phần mềm</li>
	    </ol>
	    <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Phần mềm</h2>
	</div>
	<div class="row"> 
	 	<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="{{asset('softwares/index')}}">Phần mềm</a></li>
			    <li><a href="{{asset('softwares/create')}}">Thêm phần mềm</a></li>
				<li><a href="{{asset('softwares/edit/0')}}">Chỉnh sửa phần mềm</a></li>
		        <li><a href="{{asset('softwares/delete/0')}}">Xóa phần mềm</a></li>	   
			    <li><a href="{{asset('softwares/show')}}">Thông tin phần mềm</a></li>
			</ul>
			<br>

			<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Phần Mềm</h3>
                </div>

                @if ($softwares->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Phần mềm</th>
								<td class="border"></td>
								<td class="border"></td>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($softwares as $software)
					        <tr >
					            <td>{{ $software->id }}</td>
								<td>{{ $software->name }}</td>
	                            <td><a href="<?php echo asset("softwares/information/{$software->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("softwares/edit/{$software->id}"); ?>" class="block"><span class="glyphicon glyphicon-edit"></span></a></td>
								<td><a href="<?php echo asset("softwares/delete/{$software->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$softwares->links()}}
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
			                    <th>Phần mềm</th>
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
