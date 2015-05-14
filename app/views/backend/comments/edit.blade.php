@extends('backend.modals.layout_colorbox')

@section('title')
    Cập Nhật Bình Luận
@stop

@section('title_modals')
    <div class="title slogan">Bình luận {{ $comment->id }}</div>
@stop

@section('modals')
    <form method="POST" action="{{{ URL::to('admin/comments/edit/'.$comment->id) }}}" class="container"> 
		 <div class="row">
                <div class="col-xs-12">
                 	<div class="form-group">
			            <label class="control-label" for="id">ID</label> 
			            <input type="text" name="id" id="id" value="{{ $comment->id }}" class="form-control" disabled />
			        </div>
			        <div class="form-group">
			            <label class="control-label" for="id_user">Người đăng</label> 
			            <input type="text" name="id_user" id="id_user" class="form-control" disabled 
			            	   value="<?php 
			            	   			if(!empty(UserAccount::find($comment->id_user)))
			            					echo UserAccount::find($comment->id_user)->username;
			            				else
			            					echo "[ ... ]";
			            		?>"/>
			        </div> 
			        <div class="form-group">
			            <label class="control-label" for="content">Nội dung</label> 
			            <textarea type="text" name="content" id="content" class="form-control ckeditor">{{ $comment->content }}</textarea>
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


@section('scripts')
 		<script type="text/javascript">
			CKEDITOR.config.height = 200;
			CKEDITOR.config.resize_enabled = false;
            CKEDITOR.config.skin = 'office2013';
            CKEDITOR.config.toolbar = [] ;
       </script>
@stop