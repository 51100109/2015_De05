@extends('user-accounts.main')

@section('title')
	Thêm thành viên
@stop

@section('content')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
	        <li><a href="{{asset('user-accounts/index')}}"> Thành viên</a></li>
	        @if(empty($usercheck))
	            <li class="active"> Thêm thành viên</li>
	        @else
	            <li><a href="{{asset('user-accounts/delete/0')}}"> Thêm thành viên</a></li>
	            <li class="active">{{ $usercheck->id }}</li>
	        @endif
	    </ol>
		<h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Thành Viên</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li><a href="{{asset('user-accounts/index')}}">Thành viên</a></li>
		        <li class="active"><a href="{{asset('user-accounts/create')}}">Thêm thành viên</a></li>	   
		        <li><a href="{{asset('user-accounts/delete/0')}}">Xóa thành viên</a></li>	   
			    <li><a href="{{asset('user-accounts/show')}}">Thông tin thành viên</a></li>
			</ul>
			<br>
			<div class="panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title">Thêm Thành Viên</h3>
		        </div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				            <label>Điều khoản sử dụng</label>
				        <ol>
							<li>Điền đầy đủ tất cả thông tin</li>
							<li>Tên tài khoản phải chưa tồn tại</li>
							<li>Tên tài khoản phải có ít nhất 3 ký tự</li>
							<li>Mật khẩu phải có ít nhất 6 ký tự</li>
							<li>Email phải chưa được sử dụng</li>
				        </ol>     
		        	</div>
			        <form class="form-horizontal well" href="{{asset('user-accounts/create')}}" method="post" id="form-register"> 
						    <div class="form-group">
						    	<label class="col-sm-2 control-label" for="username">Tên tài khoản</label> 
						    	<div class="col-sm-8">
						    		<input type="text" name="username" id="username" class="form-control"/>
						    	</div>
						    </div>
						    <div class="form-group">
						    	<label class="col-sm-2 control-label" for="admin">Quyền sử dụng</label> 
						    	<div class="col-sm-8">
							    	<select name="admin" id="admin" class="form-control">
							    		<option value="">Quyền sử dụng</option>
										<option value="0">Thành viên</option>
							  			<option value="1">Administrator</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="password">Mật khẩu</label>
							 	<div class="col-sm-8">
							 		<input type="password" name="password" id="password" class="form-control"/>
							 	</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="password_confirmation">Nhập lại mật khẩu</label>
								<div class="col-sm-8">
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="email">Email</label>
								<div class="col-sm-8">
									<input type="email" name="email" id="email" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="fullname">Họ và tên</label>
								<div class="col-sm-8">
									<input type="text" name="fullname" id="fullname" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="creenname">Tên hiển thị</label>
								<div class="col-sm-8">
								 	<input type="text" name="creenname" id="creenname"  class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="gender">Giới tính</label>
								<div class="col-sm-8">
									<select name="gender" id="gender" class="form-control">
										<option value="">Giới tính </option>
										<option value="1">Nam</option>
							  			<option value="2">Nữ</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="birthday">Ngày sinh</label>
								<div class="col-sm-8"> 
									<input type="date" name="birthday" id="birthday" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="address">Địa chỉ</label>
								<div class="col-sm-8"> 
								 	<input type="text" name="address" id="address" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="phone">Điện thoại</label>
								<div class="col-sm-8">
									<input type="text" name="phone" id="phone" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
							<center>
								<input type="submit" class="btn btn-default" value="Xác nhận">
								<input type="reset" class="btn btn-default" value="Reset">
							</center>
							</div>
						</form>
		        </div>
		    </div>
		 </div>
	</div>
	<script type="text/javascript">
	
		$("#form-register").validate({
			rules:{
				username:{
					required:true,
					minlength:3,
					remote:{
						url:"{{asset('user-accounts/check-username')}}",
						type: "POST"
					}
				},
				password:{
					required:true,
					minlength:6
				},
				password_confirmation:{
					equalTo:"#password"
				},
				email:{
					required:true,
					email:true,
					remote:{
						url:"{{asset('user-accounts/check-email')}}",
						type: "POST"
					}
				},
				fullname:{
					required:true,
				},
				creenname:{
					required:true,
				},
				birthday:{
					required:true,
				},
				address:{
					required:true,
				},
				phone:{
					required:true,
					number:true,
				},
				gender:{
					required:true,
				},
				admin:{
					required:true,
				},
			},
			messages:{
				username:{
					required:"Vui lòng nhập tên tài khoản",
					minlength:"Tên tài khoản phải có 3 ký tự trở lên",
					remote:"Tài khoản đã tồn tại"
				},
				password:{
					required:"Vui lòng nhập mật khẩu",
					minlength:"Mật khẩu phải có 6 ký tự trở lên"
				},
				password_confirmation:{
					equalTo:"Mật khẩu xác nhận không đúng"
				},
				email:{
					required:"Vui lòng nhập Email",
					email:"Định đạng Email không đúng",
					remote:"Email đã được sử dụng"
				},
				fullname:{
					required:"Vui lòng nhập họ và tên"
				},
				creenname:{
					required:"Vui lòng nhập tên hiển thị"
				},
				birthday:{
					required:"Vui lòng nhập ngày sinh"
				},
				address:{
					required:"Vui lòng nhập địa chỉ"
				},
				phone:{
					required:"Vui lòng nhập số điện thoại",
					number:"Số điện thoại không đúng định dạng"
				},
				gender:{
					required:"Vui lòng chọn giới tính",
				},
				admin:{
					required:"Vui lòng chọn quyền sử dụng",
				},
			},
			errorClass: "help-block",
			
			highlight:function(element, errorClass, validClass) {
					$(element).parents('.form-control').addClass('.has-error');
				},
			unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.form-control').removeClass('.has-error');
					$(element).parents('.form-control').addClass('.has-success');
				}
		});

	</script>

@stop