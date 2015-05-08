@extends('front.layouts.mainlayout')

@section('title')
{{$categoryname}} - Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        @if (count($softwares) === 0)
    		<h1>No Item</h1>
		@else
			<h1 class="content-subhead">{{{$categoryname}}}</h1> <!-- Thai -->
    		@foreach ($softwares as $software)
    			@include('front.includes.softwareItem',['softwareItem'=>$software])
			@endforeach
			<div class="pull-right">{{ $softwares->links() }}</div>
		@endif  
       
@endsection