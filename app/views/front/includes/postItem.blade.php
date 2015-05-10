<div class="head">     
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"  media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}"  media="all" rel="stylesheet">
</div>

<?php $numCharacter = 600; ?>

<div class="row">
	<div>
		<div class="post-list-title">{{{$postItem->title}}}</div>
		<p>{{{substr(strip_tags($postItem->content),0,$numCharacter)."..."}}}</p>
		<p>
			<a class="btn btn-info btn-xs" href={{ URL::to('/post/'.$postItem->id) }} role="button"> <i class="fa fa-share"></i> Xem chi tiết</a>
			@if(Auth::check())
				@if (Auth::user()->id == $postItem->id_user)
					<a class="btn btn-warning btn-xs" href={{ URL::to('/post/edit/'.$postItem->id) }} role="button"><i class="fa fa-pencil-square-o"></i> Sửa bài viết</a>
					<a class="btn btn-danger btn-xs" href={{ URL::to('/post/delete/'.$postItem->id) }} role="button"><i class="fa fa-trash"></i> Xóa bài viết</a>
				@endif
			@endif			
		</p>
		<p class="post-list-edit">Chỉnh sửa lần cuối: {{{ date("d-M-y H:i:s" ,strtotime($postItem->updated_at)) }}}</p>
	</div>
</div>
<!--/row-->