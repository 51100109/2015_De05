<?php $numCharacter = 600; ?>

<div class="row">
	<div>
		<h2>{{{$postItem->title}}}</h2>
		<p>{{{substr(strip_tags($postItem->content),0,$numCharacter)."..."}}}</p>
		<p>
			<a class="btn btn-default" href={{ URL::to('/post/'.$postItem->id) }} role="button">Xem chi tiết »</a>
			@if(Auth::check())
				@if (Auth::user()->id == $postItem->id_user)
					<a class="btn btn-default" href={{ URL::to('/post/edit/'.$postItem->id) }} role="button">Sửa bài viết</a>
					<a class="btn btn-default" href={{ URL::to('/post/delete/'.$postItem->id) }} role="button">Xóa bài viết</a>
				@endif
			@endif
		</p>
	</div>
</div>
<!--/row-->