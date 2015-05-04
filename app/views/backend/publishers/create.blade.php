@extends('backend.modals.layout_colorbox')

@include('backend.publishers.hidden')

@section('title')
    Thêm Nhà Phát Hành
@stop

@section('title_modals')
    Thêm nhà phát hành
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
    <form method="POST" action="{{asset('admin/publishers/create')}}" class="container register-publisher"> 
		 <div class="row">
                <div class="col-xs-3">
                    <img src="{{asset('assets/image/publishers/publisher_create.png')}}" class="image_size300" alt="add">          
                </div>
                <div class="col-xs-8">
			        <div class="form-group">
			            <label class="control-label" for="name">Tên nhà phát hành</label> 
			            <input type="text" name="name" id="name" class="form-control"/>
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
			$(".register-publisher").validate({
		        rules:{
		            name:{
		              	required:true,
		              	remote:{
			                url: "{{asset('admin/publishers/check-name')}}",
			                type: "POST",
			            },
		            },
		        },
		        messages:{
		            name:{
		                required:"Vui lòng nhập tên nhà phát hành",
		                remote:"Nhà phát hành đã tồn tại",
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