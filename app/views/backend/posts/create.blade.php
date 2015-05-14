@extends('backend.modals.layout_colorbox')

@section('title')
    Thêm Bài Đăng
@stop

@section('title_modals')
    <div class="title slogan">Thêm bài đăng</div>
@stop

@section('modals')
    <form method="POST" action="{{{ URL::to('admin/posts/create') }}}" class="container add-post"> 
		 <div class="row">
                <div class="col-xs-12">
			        <div class="form-group">
			            <label class="control-label" for="title">Tiêu đề</label> 
			            <input type="text" name="title" id="title" class="form-control"/>
			        </div> 
			        <div class="form-group">
			            <label class="control-label" for="content">Nội dung</label> 
			            <textarea type="text" name="content" id="content" class="form-control ckeditor"></textarea>
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
			$(".add-post").validate({
		        rules:{
		            title:{
		              	required:true,
		              	remote:{
			                url: "{{{ URL::to('admin/posts/check-title') }}}",
			                type: "POST"
			              }
		            },
		            content:{
		              	required:true,
		            },
		        },
		        messages:{
		            title:{
		                required:"Vui lòng nhập tên tiêu đề",
		                remote:"Tiêu đề không hợp lệ",
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