<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> @yield('title') </title>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>@yield('title')</title>
		
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>
		
		<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('assets/css/demo.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}" />
		
		

		<!-- JavaScript -->
		 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script> 
		 <script type="text/javascript" src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
		 <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		 <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.js')}}"></script>
<!-- 		 <script type="text/javascript" src="{{asset('assets/tablesorter/js/jquery.tablesorter.js')}}"></script> -->
<!-- 		 <script type="text/javascript" src="{{asset('assets/tablesorter/js/tables.js')}}"></script> -->


		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>

		<script type="text/javascript" src="{{asset('js/notify.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/js.js')}}"></script>
		
		
		
		@yield('moreLibrary')