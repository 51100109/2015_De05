@extends('front.layouts.auth')

@section('title')
Đổi mật khẩu
@endsection

@section('content')


{{ Form::open(array('url' => 'changepass')) }}
		<h2>Đổi mật khẩu</h2>
		
		@if ($errors->any())
 
		<ul style="color:red;">
		 
		{{ implode('', $errors->all('<li>:message</li>')) }}
		 
		</ul>
		 
		@endif
		 
		@if (Session::has('message'))
		 
		<p>{{ Session::get('message') }}</p>
		 
		@endif
		
		@if (Session::has('flash_error'))
        <div class="bg-danger">{{ Session::get('flash_error') }}</div>
    	@endif
		<input type="password" name="password" id="password" placeholder="Mật khẩu mới" class="form-control"/>
		<input type="password" name="cpassword" id="password_confirmation" placeholder="Lặp lại mật khẩu mới" class="form-control"/>
		<p>{{ Form::submit('Xác nhận',array('class' => 'btn btn-md btn-primary btn-block')) }}</p>
	{{ Form::close() }}
@endsection