<!DOCTYPE html>
<html>
<head>
	@include('front.includes.head')
</head>
<body>
	<div class="container" >
		@include('front.includes.header')

		<div  class="center" >
		@yield("content")		
		</div>
	</div>
</body>
</html>
