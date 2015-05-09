@extends('backend.modals.layout_colorbox')

@section('title')
    Thêm Danh Mục Phần Mềm
@stop
					
@section('title_modals')
    <div class="title slogan"> Thêm danh mục phần mềm</div>
@stop

@section('modals')
    <form method="POST" action="{{{ URL::to('admin/categories/create') }}}" class="container register-category"> 
		 <div class="row">
                <div class="col-xs-3">
                    <img src="{{asset('assets/image/categories/categories_create.png')}}" class="image_size300" alt="add">          
                </div>
                <div class="col-xs-8">
			        <div class="form-group">
			            <label class="control-label" for="name">Tên danh mục</label> 
			            <input type="text" name="name" id="name" class="form-control"/>
			        </div> 
			        <div class="form-group">
			            <label class="control-label" for="image">Hình ảnh</label> 
			            <input type="text" name="image" id="image" class="form-control" value="http://ai-i2.infcdn.net/icons_siandroid/png/300/5456/5456887.png" />
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
			$(".register-category").validate({
		        rules:{
		            name:{
		              	required:true,
		              	remote:{
			                url: "{{{ URL::to('admin/categories/check-name') }}}",
			                type: "POST",
			            },
		            },
		            image:{
		              	required:true,
		            },
		        },
		        messages:{
		            name:{
		                required:"Vui lòng nhập tên danh mục phần mềm",
		                remote:"Danh mục phần mềm đã tồn tại",
		            },
		            image:{
		              	required:"Vui lòng nhập hình ảnh danh mục",
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