<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>@yield('title')</title>
		<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('assets/css/demo.css')}}" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
	</head>
	<body>
		<div class="container">
			@yield('content')
		</div>
	</body>
</html>
