<!DOCTYPE html>
<html>
<head>
	@include('front.includes.head')
</head>
<body>
	<div class="container" >
		@include('front.includes.header')

		<div class="col-xs-12 col-sm-9">
			@yield("content")
		</div>

		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
			@include('front.includes.sidebar')
		</div>		
	</div>
	@include('front.includes.footer')
</body>
</html>

