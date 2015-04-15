@extends('user-accounts.main')

@section('title')
	Xóa thành viên
@stop

@section('content')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li><a href="{{asset('user-accounts/index')}}"> Thành viên</a></li>
	        @if(empty($usercheck))
	            <li class="active"> Xóa thành viên</li>
	        @else
	            <li><a href="{{asset('user-accounts/delete/0')}}"> Xóa thành viên</a></li>
	            <li class="active">{{ $usercheck->id }}</li>
	        @endif
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Thành Viên</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li><a href="{{asset('user-accounts/index')}}">Thành viên</a></li>
		        <li><a href="{{asset('user-accounts/create')}}">Thêm thành viên</a></li>	   
		        <li class="active"><a href="{{asset('user-accounts/delete/0')}}">Xóa thành viên</a></li>	   
			    <li><a href="{{asset('user-accounts/show')}}">Thông tin thành viên</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Xóa Thành Viên</h3>
		        </div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <label>Điều khoản sử dụng</label>
				        <ol>
				        	<li>Chọn tên tài khoản muốn xóa</li>
				        </ol>     
		        	</div>
			        <div>
			        	<form class="well" href="{{asset('user-accounts/delete')}}" method="post"> 
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
		                        <label>Tên tài khoản</label>
		                        <select name='id' id='id' class='form-control'>
		                        	<option value="0">[ Chọn tài khoản ]</option>
		                            @foreach($username as $user)
		                            <option value="{{$user->id}}" <?php if(!empty($usercheck)&&($user->id == $usercheck->id)) echo "selected='selected'"; ?>>{{$user->username}} - ID: {{$user->id}}</option>
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