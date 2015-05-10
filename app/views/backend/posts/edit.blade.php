@extends('backend.modals.layout_colorbox')

@section('title')
    Cập Nhật Bài Đăng
@stop

@section('title_modals')
    <div class="title slogan">Bài đăng {{ $post->id }}</div>
@stop

@section('modals')
    <form method="POST" action="{{{ URL::to('admin/posts/edit/'.$post->id) }}}" class="container edit-post"> 
		 <div class="row">
                <div class="col-xs-12">
                 	<div class="form-group">
			            <label class="control-label" for="id">ID</label> 
			            <input type="text" name="id" id="id" value="{{ $post->id }}" class="form-control" disabled />
			        </div>
			        <div class="form-group">
			            <label class="control-label" for="id">Người đăng</label> 
			            <input type="text" name="id" id="id" class="form-control" disabled 
			            		value="<?php
			            					if(!empty(UserAccount::find($post->id_user)))
			            						echo UserAccount::find($post->id_user)->username;
			            					else
			            						echo "[ ... ]"
			            				?>
			            		"/>
			        </div> 
			        <div class="form-group">
			            <label class="control-label" for="title">Tiêu đề</label> 
			            <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control"/>
			        </div> 
			        <div class="form-group">
			            <label class="control-label" for="content">Nội dung</label> 
			            <textarea type="text" name="content" id="content" class="form-control ckeditor">{{ $post->content }}</textarea>
			        </div> 
			        <div class="form-group">
			        	<div class="text-right">
			            	<button type="submit" class="btn btn-primary width100">Xác nhận</button>
			            	<button type="reset" class="btn btn-warning width100">Tạo lại</button>
			            	<button type="button" class="btn btn-default close_colorbox width100">Đóng</button>
			            </div>
			        </div>
			    </div>
		</div>
    </form>
@stop

@section('scripts_validator')
	<script type="text/javascript">
		$(document).ready(function() {
			$(".edit-post").validate({
		        rules:{
		            title:{
		              	required:true,
		            },
		            content:{
		              	required:true,
		            },
		        },
		        messages:{
		            title:{
		                required:"Vui lòng nhập tên tiêu đề",
		            },
		        },
		        errorElement: 'span',
		        errorClass: 'help-block',
		        highlight: check_highlight,
                unhighlight: check_unhighlight,
		    });
		});
	</script>
@stop