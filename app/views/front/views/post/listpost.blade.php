@extends('front.layouts.mainlayout')

@section('title')
Các bài đăng - Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
   		 @if(Auth::check())
   		 <p class="post-list">
   		 	<a href="{{ URL::to('post/new') }}" class="btn btn-success pull-right" role="button"><i class="fa fa-file"></i> Đăng bài mới</a>
   		 	</p>
   		 @endif
        @if (count($posts) === 0)
    		<h1>No Item</h1>
		@else
    		@foreach ($posts as $post)
    			@include('front.includes.postItem',['postItem'=>$post])
			@endforeach
			<div class="pull-right">{{ $posts->links()}}</div>
		@endif 
@endsection