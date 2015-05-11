@extends('front.layouts.mainlayout')

@section('title')
Các phần mềm - Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        @if (count($softwares) === 0)
    		<h1>No Item</h1>
		@else
            <h1 class="content-subhead">Phần mềm mới nhất</h1>
    		@foreach ($softwares as $software)
    			@include('front.includes.softwareItem',['softwareItem'=>$software])
			@endforeach
			<div class="pull-right">{{ $softwares->links() }}</div>			
		@endif 
@endsection