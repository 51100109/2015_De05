@extends('backend.modals.layout_colorbox')

@section('title')
    Thêm Nhà Phát Hành
@stop

@section('title_modals')
    <div class="title slogan">Thêm nhà phát hành</div>
@stop

@section('modals')
    <form method="POST" action="{{{ URL::to('admin/publishers/create') }}}" class="container register-publisher"> 
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
			$(".register-publisher").validate({
		        rules:{
		            name:{
		              	required:true,
		              	remote:{
			                url: "{{{ URL::to('admin/publishers/check-name') }}}",
			                type: "POST",
			            },
		            },
		        },
		        messages:{
		            name:{
		                required:"Vui lòng nhập tên nhà phát hành",
		                remote:"Nhà phát hành đã tồn tại hoặc không hợp lệ",
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