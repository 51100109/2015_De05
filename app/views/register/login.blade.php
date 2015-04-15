@extends("register.main")

@section('title')
	Đăng nhập
@endsection

@section('content')
	<form method="post" action="{{asset('user/login')}}" id="form-login">
		@if(Session::has('register_success'))
			{{Session::get('register_success')}}
			<?php Session::forget("register_success");?>
		@endif
		<h2>Đăng nhập</h2>
		<input type="text" name="user_input" id="user_input" placeholder="Username or Email" class="form-control"/>
		<input type="password" name="password" id="password" placeholder="Password" class="form-control"/>
		@if(isset($error_message))
			<label class="error">{{$error_message}}</label>
		@endif
		<p>Bạn chưa có tài khoản <a href="{{asset('user/register')}}">Đăng ký</a></p>
		<button class="btn btn-md btn-primary btn-block">Đăng nhập</button>
	</form>