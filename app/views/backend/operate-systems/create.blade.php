@extends('backend.modals.layout_colorbox')

@include('backend.operate-systems.hidden')

@section('title')
    Thêm Hệ Điều Hành
@stop

@section('title_modals')
    Thêm hệ điều hành
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
    <form method="POST" action="{{asset('admin/operate-systems/create')}}" class="container register-system"> 
		 <div class="row">
                <div class="col-xs-3">
                    <img src="{{asset('assets/image/systems/system_create.png')}}" class="image_size300" alt="add">          
                </div>
                <div class="col-xs-8">
			        <div class="form-group">
			            <label class="control-label" for="name">Tên hệ điều hành</label> 
			            <input type="text" name="name" id="name" class="form-control"/>
			        </div> 
			        <div class="form-group">
			            <label class="control-label" for="image">Hình ảnh</label> 
			            <input type="text" name="image" id="image" class="form-control" value="http://freedroid.ru/uploads/posts/2014-02/1392829440_gg.png" />
			        </div>
                    <div class="form-group">
                        <label class="col-xs-12 control-label null" for="id_category">Danh mục</label><br>
                        @foreach($category as $item)
                            <div class="col-xs-12 col-sm-6 margin10_top">
                                <input type="checkbox" name="id_category[]" id="id_category" value="{{ $item->id }}" class="close check_box_20" style="float:left" />
                                <img src="{{ $item->image }}" class="size30 margin_left20" alt="icon"> {{ $item->name }}
                            </div>
                        @endforeach
                    </div>
			        <div class="form-group">
			        	<div class="col-xs-12 text-right margin10_top">
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
            $(".register-system").validate({
                rules:{
                    name:{
                        required:true,
                        remote:{
                            url: "{{asset('admin/operate-systems/check-name')}}",
                            type: "POST",
                        },
                    },
                    image:{
                        required:true,
                    },
                },
                messages:{
                    name:{
                        required:"Vui lòng nhập tên hệ điều hành",
                        remote:"Hệ điều hành đã tồn tại",
                    },
                    image:{
                        required:"Vui lòng nhập hình ảnh hệ điều hành",
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