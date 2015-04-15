
@extends("register.main")

@section('title')
	Đăng ký
@endsection

@section('content')
	<form method="post" action="{{asset('user/register')}}" id="form-register">
		<h2>Đăng ký tài khoản</h2>
		<input type="text" name="username" id="username" placeholder="Username" class="form-control"/>
		<input type="password" name="password" id="password" placeholder="Password" class="form-control"/>
		<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control"/>
		<input type="email" name="email" id="email" placeholder="Email" class="form-control"/>
		<input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control"/>
		<input type="text" name="middlename" id="middlename" placeholder="Middle Name" class="form-control"/>
		<input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control"/>
		<input type="text" name="creenname" id="creenname" placeholder="Creen Name" class="form-control"/>
		<select name="gender" id="gender" class="form-control">
			<option value="1">Male</option>
  			<option value="2">Female</option>
		</select>
		<input type="date" name="birthday" id="birthday" placeholder="Birthday" class="form-control"/>
		<input type="text" name="address" id="address" placeholder="Address" class="form-control"/>
		<input type="text" name="nationality" id="nationality" placeholder="Nationality" class="form-control"/>
		<input type="number" name="phone" id="phone" placeholder="Phone" class="form-control"/>
		<button class="btn btn-md btn-primary btn-block">Đăng ký</button>
	</form>
	<script type="text/javascript">
		$("#form-register").validate({
			rules:{
				username:{
					required:true,
					minlength:3,
					remote:{
						url:"{{asset('user/check-username')}}",
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
						url:"{{asset('user/check-email')}}",
						type: "POST"
					}
				}
			}
		})
	</script>
@endsection