@extends('front.layouts.mainlayout')

@section('title')
Softsharing - Home
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        @if (count($softwares) === 0)
    		<h1>No Item</h1>
		@else
    		@foreach ($softwares as $software)
    			@include('front.includes.softwareItem',['softwareItem'=>$software])
			@endforeach
		@endif 
@endsection