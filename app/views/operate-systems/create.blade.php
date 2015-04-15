@extends('operate-systems.main')

@section('title')
	Thêm hệ điều hành
@stop

@section('content')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"></i> Trang Chủ</a></li>
	        <li><a href="{{asset('operate-systems/index')}}"></i> Hệ điều hành</a></li>
	        <li class="active"> Thêm hệ điều hành</li>
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Hệ Điều Hành</h2>
	</div>
	<div class="row"> 
	 	<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li><a href="{{asset('operate-systems/index')}}">Hệ điều hành</a></li>
			    <li class="active"><a href="{{asset('operate-systems/create')}}">Thêm hệ điều hành</a></li>
				<li><a href="{{asset('operate-systems/edit/0')}}">Chỉnh sửa hệ điều hành</a></li>
		        <li><a href="{{asset('operate-systems/delete/0')}}">Xóa hệ điều hành</a></li>	    
		        <li><a href="{{asset('operate-systems/show')}}">Thông tin hệ điều hành</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Thêm Hệ Điều Hành</h3>
		        </div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <label>Điều khoản sử dụng</label>
				        <ol>
				            <li>Tên các hệ điều hành không được giống nhau</li>
				            <li>Tên hệ điều hành không được để trống</li>
				        </ol>     
		        	</div>
			        <div>
			        	<form class="well" href="{{asset('publishers/create')}}" method="post"> 
							@if ($errors->any())
								<div class='alert alert-danger'>
									<ul>	
										{{ implode('', $errors->all('<span class="glyphicon glyphicon-exclamation-sign"></span> :message<br>')) }}
									</ul>
								</div>   
							@endif
						    <p>
						    	<label>Tên hệ điều hành</label>
						    	<input type='text' name='name' id='name' placeholder="Nhập tên hệ điều hành" class='form-control' />
							</p>
							<p><button class="btn btn-default">Xác nhận</button></p>
						</form>
					</div>
		        </div>
		    </div>
		</div>
	</div>
@stop