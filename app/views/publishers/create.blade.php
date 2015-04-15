@extends('publishers.main')

@section('title')
	Thêm nhà phát hành
@stop

@section('content')
    <div class="row">
	    <ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"></i> Trang Chủ</a></li>
	        <li><a href="{{asset('publishers/index')}}"></i> Nhà phát hành</a></li>
	        <li class="active"> Thêm nhà phát hành</li>
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Nhà Phát Hành</h2>
    </div>
    <div class="row"> 
        <div class="col-md-12">
			<ul class="nav nav-tabs">
				<li><a href="{{asset('publishers/index')}}">Nhà phát hành</a></li>
			    <li class="active"><a href="{{asset('publishers/create')}}">Thêm nhà phát hành</a></li>
		        <li><a href="{{asset('publishers/edit/0')}}">Chỉnh sửa nhà phát hành</a></li>
		        <li><a href="{{asset('publishers/delete/0')}}">Xóa nhà phát hành</a></li>	   
			    <li><a href="{{asset('publishers/show')}}">Thông tin nhà phát hành</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Thêm Nhà Phát Hành</h3>
		        </div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <label>Điều khoản sử dụng</label>
				        <ol>
				            <li>Tên các nhà phát hành không được giống nhau</li>
				            <li>Tên nhà phát hành không được để trống</li>
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
						    	<label>Tên nhà phát hành</label>
						    	<input type='text' name='name' id='name' placeholder="Nhập tên nhà phát hành" class='form-control' />
							</p>
							<p><button class="btn btn-default">Xác nhận</button></p>
						</form>
					</div>
		        </div>
		    </div>
		 </div>
	</div>
@stop