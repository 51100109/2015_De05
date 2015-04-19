@extends('front.layouts.mainlayout')

@section('title')
Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        @foreach ($softwares as $software)
    		@include('front.includes.softwareItem',['softwareItem'=>$software])
		@endforeach
@endsection