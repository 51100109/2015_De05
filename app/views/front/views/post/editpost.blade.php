@extends('front.layouts.mainlayout') 
@section('title')
Sửa bài - Softsharing 
@endsection 

@section('moreLibrary')
	<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
@endsection


@section('content')
<p class="pull-right visible-xs">
	<button type="button" class="btn btn-primary btn-xs"
		data-toggle="offcanvas">Toggle nav</button>
</p>
@if (Session::has('flash_notice'))
<div class="bg-danger">{{ Session::get('flash_notice') }}</div>
@endif



	<form style="width:100%" method="post">
		<script>
			CKEDITOR.config.height = 400;
			CKEDITOR.config.resize_enabled = false;
		</script>
		<div class="form-group">
			<label for="title"><h3 class="post-list-muc">Tiêu đề</h3></label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề" value="{{{$post->title}}}">
		</div>
		<div class="form-group">
			<label for="content"><h3 class="post-list-muc">Nội dung</h3></label>
			<textarea class="ckeditor form-control" name="content" id="content"  style="resize: none" value={{Purifier::clean($post->content)}}></textarea>
		</div>
		
		<button type="submit" class="btn btn-success pull-right post-list-edit-button"><i class="fa fa-floppy-o"></i> Lưu thay đổi</button>
	</form>



@endsection
