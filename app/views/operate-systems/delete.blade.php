@extends('operate-systems.main')

@section('title')
	Xóa hệ điều hành
@stop

@section('content')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li><a href="{{asset('operate-systems/index')}}"> Hệ điều hành</a></li>
	        @if(empty($systemcheck))
	            <li class="active"> Xóa hệ điều hành</li>
	        @else
	            <li><a href="{{asset('operate-systems/edit/0')}}"> Xóa hệ điều hành</a></li>
	            <li class="active">{{ $systemcheck->id }}</li>
	        @endif
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Hệ Điều Hành</h2>
	</div>
	<div class="row"> 
	 	<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li><a href="{{asset('operate-systems/index')}}">Hệ điều hành</a></li>
			    <li><a href="{{asset('operate-systems/create')}}">Thêm hệ điều hành</a></li>
		       	<li><a href="{{asset('operate-systems/edit/0')}}">Chỉnh sửa hệ điều hành</a></li>
		        <li  class="active"><a href="{{asset('operate-systems/delete/0')}}">Xóa hệ điều hành</a></li>
			    <li><a href="{{asset('operate-systems/show')}}">Thông tin hệ điều hành</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Xóa Hệ Điều Hành</h3>
		        </div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <label>Điều khoản sử dụng</label>
				        <ol>
				        	<li>Chọn tên hệ điều hành muốn xóa</li>
				        </ol>     
		        	</div>
			        <div>
			        	<form class="well" href="{{asset('operate-systems/delete')}}" method="post"> 
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
		                        <label>Tên hệ điều hành</label>
		                        <select name='id' id='id' class='form-control'>
		                            <option value="0">[ Chọn hệ điều hành ]</option>
		                            @foreach($systemname as $sys)
		                            <option value="{{$sys->id}}" <?php if(!empty($systemcheck)&&($sys->id == $systemcheck->id)) echo "selected='selected'"; ?>>ID: {{$sys->id}} - {{$sys->name}}</option>
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