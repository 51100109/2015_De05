@extends('backend.modals.layout_colorbox')

@include('backend.categories.hidden')

@section('title')
    Thêm Danh Mục Phần Mềm
@stop

@section('title_modals')
    Thêm danh mục phần mềm
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
    <form method="POST" action="{{asset('admin/categories/create')}}" class="container register-category"> 
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
			            <input type="text" name="image" id="image" class="form-control" value="http://freedroid.ru/uploads/posts/2014-02/1392829440_gg.png" />
			        </div>  
			        <div class="form-group">
			        	<div class="text-right">
			            	<button type="submit" class="btn btn-primary">Xác nhận</button>
			            	<button type="reset" class="btn btn-warning">Tạo lại</button>
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
			                url: "{{asset('admin/categories/check-name')}}",
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