@extends('softwares.main')

@section('title')
	Xóa phần mềm
@stop

@section('content')
    <div class="row">
	    <ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li><a href="{{asset('softwares/index')}}"> Phần mềm</a></li>
	        @if(empty($softwarecheck))
	            <li class="active"> Xóa phần mềm</li>
	        @else
	            <li><a href="{{asset('softwares/delete/0')}}"> Xóa phần mềm</a></li>
	            <li class="active">{{ $softwarecheck->id }}</li>
	        @endif
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Phần mềm</h2>
	</div>
	<div class="row"> 
	 	<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li><a href="{{asset('softwares/index')}}">Phần mềm</a></li>
			    <li><a href="{{asset('softwares/create')}}">Thêm phần mềm</a></li>
				<li><a href="{{asset('softwares/edit/0')}}">Chỉnh sửa phần mềm</a></li>
		        <li class="active"><a href="{{asset('softwares/delete/0')}}">Xóa phần mềm</a></li>	   
			    <li><a href="{{asset('softwares/show')}}">Thông tin phần mềm</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Xóa Phần Mềm</h3>
		        </div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <label>Điều khoản sử dụng</label>
				        <ol>
				        	<li>Chọn ID phần mềm muốn xóa</li>
				        </ol>     
		        	</div>
			        <div>
			        	<form class="well" href="{{asset('softwares/delete')}}" method="post"> 
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
		                        <label>ID phần mềm</label>
		                        <select name='id' id='id' class='form-control'>
		                        	<option value="0">[ Chọn ID ]</option>
		                            @foreach($softwarename as $soft)
		                            <option value="{{$soft->id}}" <?php if(!empty($softwarename)&&($soft->id == $softwarename->id)) echo "selected='selected'"; ?>>ID: {{$soft->id}} - {{$pub->name}}</option>
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