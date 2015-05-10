@extends('front.layouts.mainlayout')

@section('title')
{{{$post->title}}} - Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        @if(Auth::check())
				@if (Auth::user()->id == $post->id_user)
					<div class=text-right>
						<a class="btn btn-primary" href={{ URL::to('/post/edit/'.$post->id) }} role="button"><span class="glyphicon glyphicon-pencil"></span> Sửa bài viết</a>
						<a class="btn btn-danger" href={{ URL::to('/post/delete/'.$post->id) }} role="button"><i class="fa fa-trash"></i>  Xóa bài viết</a>
					</div>	
					
				@endif
		@endif
		<h2 class="post-list-title1">{{{$post->title}}}</h2>
		<div id="postcontent">
			{{Purifier::clean($post->content)}}
		</div>
		@include('front.includes.comment',['isSoftware'=>0 ,'post'=>$post])
@endsection