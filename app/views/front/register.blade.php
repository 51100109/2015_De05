@extends('front.layout')

@section('content')
    <h1>Register</h1>


@if ($errors->any())
 
<ul style="color:red;">
 
{{ implode('', $errors->all('<li>:message</li>')) }}
 
</ul>
 
@endif
 
@if (Session::has('message'))
 
<p>{{ Session::get('message') }}</p>
 
@endif

    <!-- check for login error flash var -->
    @if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif

    {{ Form::open(array('url' => 'register_action')) }}
 
        
        <!-- username field -->
	    <p>
	        {{ Form::label('username', 'Username') }}<br/>
	        {{ Form::text('username', Input::old('username')) }}
	    </p>
	    
	    <!-- email field -->
	    <p>
	        {{ Form::label('email', 'Email') }}<br/>
	        {{ Form::text('email', Input::old('email')) }}
	    </p>
 
    	<!-- password field -->
    	<p>
        	{{ Form::label('password', 'Password') }}<br/>
        	{{ Form::password('password') }}
   		</p>
 
     	<!-- confirm password field -->
    	<p>
        	{{ Form::label('cpassword', 'Confirm Password') }}<br/>
        	{{ Form::password('cpassword') }}
   		</p>
   		
   		 <!-- Fullname field -->
    	<p>
        	{{ Form::label('fullname', 'Fullname') }}<br/>
        	{{ Form::password('fullname') }}
   		</p>
   		
   		 <!-- Creenname field -->
    	<p>
        	{{ Form::label('creenname', 'Creenname') }}<br/>
        	{{ Form::password('creenname') }}
   		</p>
   		
   		
 
        <p>{{ Form::submit('Register') }}</p>
 
    {{ Form::close() }}
@stop