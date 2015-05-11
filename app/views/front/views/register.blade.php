@extends('front.layouts.auth')

@section('title')
Đăng ký
@endsection

@section('content')


{{ Form::open(array('url' => 'register_action')) }}
		<h2>Đăng ký tài khoản</h2>
		
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
		
		
		<input type="text" name="username" id="username" placeholder="Username" class="form-control"/>
		<input type="password" name="password" id="password" placeholder="Password" class="form-control"/>
		<input type="password" name="cpassword" id="password_confirmation" placeholder="Confirm Password" class="form-control"/>
		<input type="email" name="email" id="email" placeholder="Email" class="form-control"/>
		<input type="text" name="fullname" id="fullname" placeholder="Full Name" class="form-control"/>
<!-- 		<input type="text" name="middlename" id="middlename" placeholder="Middle Name" class="form-control"/> -->
<!-- 		<input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control"/> -->
		<input type="text" name="creenname" id="creenname" placeholder="Creen Name" class="form-control"/>
		<select name="gender" id="gender" class="form-control">
			<option value="1">Male</option>
  			<option value="2">Female</option>
		</select>
		<input type="date" name="birthday" id="birthday" placeholder="Birthday" class="form-control"/>
		<input type="text" name="address" id="address" placeholder="Address" class="form-control"/>
<!-- 		<input type="text" name="nationality" id="nationality" placeholder="Nationality" class="form-control"/> -->
		<input type="text" name="phone" id="phone" placeholder="Phone" class="form-control"/>
		<p>{{ Form::submit('Register',array('class' => 'btn btn-md btn-primary btn-block')) }}</p>
	{{ Form::close() }}
	
<!-- 	<script type="text/javascript"> -->
<!-- // 		$("#form-register").validate({ -->
<!-- // 			rules:{ -->
<!-- // 				username:{ -->
<!-- // 					required:true, -->
<!-- // 					minlength:3, -->
<!-- // 					remote:{ -->
<!-- // 						url:"{{asset('home/check-username')}}", -->
<!-- // 						type: "POST" -->
<!-- // 					} -->
<!-- // 				}, -->
<!-- // 				password:{ -->
<!-- // 					required:true, -->
<!-- // 					minlength:6 -->
<!-- // 				}, -->
<!-- // 				password_confirmation:{ -->
<!-- // 					equalTo:"#password" -->
<!-- // 				}, -->
<!-- // 				email:{ -->
<!-- // 					required:true, -->
<!-- // 					email:true, -->
<!-- // 					remote:{ -->
<!-- // 						url:"{{asset('home/check-email')}}", -->
<!-- // 						type: "POST" -->
<!-- // 					} -->
<!-- // 				} -->
<!-- // 			} -->
<!-- // 		}) -->
<!-- 	</script> -->

@endsection