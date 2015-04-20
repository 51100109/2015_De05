@extends('front.layouts.mainlayout')

@section('title')
{{{$software->name}}} - Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
		<h1>display $software here</h1>
		@include('front.includes.comment',['isSoftware'=>true ,'software'=>$software])
@endsection