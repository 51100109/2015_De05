@extends('front.layouts.auth')

@section('title')
Đăng nhập
@endsection

@section('content')
	<h1>Đăng nhập</h1>

    

    {{Form::open(array('url' => 'login'))}}
    <!-- check for login error flash var -->
    @if (Session::has('flash_error'))
        <div class="bg-danger">{{ Session::get('flash_error') }}</div>
    @endif

    <!-- username field -->
    <p>
        {{ Form::label('username', 'Username') }}<br/>
        {{ Form::text('username', Input::old('username'),array('class' => 'form-control')) }}
    </p>

    <!-- password field -->
    <p>
        {{ Form::label('password', 'Password') }}<br/>
        {{ Form::password('password',array('class' => 'form-control')) }}
    </p>
	<p>Bạn chưa có tài khoản <a href="{{asset('register')}}">Đăng ký</a></p>
    <!-- submit button -->
    <p>{{ Form::submit('Đăng nhập',array('class' => 'btn btn-md btn-primary btn-block')) }}</p>

    {{ Form::close() }}
@endsection