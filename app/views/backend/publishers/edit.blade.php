@extends('backend.modals.layout_colorbox')

@include('backend.publishers.hidden')

@section('title')
    Cập Nhật Nhà Phát Hành
@stop

@section('title_modals')
    Cập nhật nhà phát hành
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
	<form method="POST" action="<?php echo asset("admin/publishers/edit/{$publisher->id}"); ?>" class="container edit-publisher"> 
        <div class="row">
            <div class="col-xs-3">
                <img src="{{asset('assets/image/publishers/publisher_edit.png')}}" class="image_size300" alt="{{ $publisher->id }}">          
            </div>
            <div class="col-xs-8">
                    <div class="form-group">
                        <label class="control-label" for="id">ID</label> 
                        <input type="text" name="id" id="id" value="{{ $publisher->id }}" class="form-control" disabled/>
                    </div>                
                    <div class="form-group">
                        <label class="control-label" for="name">Tên nhà phát hành</label> 
                        <input type="text" name="name" id="name" value="{{ $publisher->name }}" class="form-control"/>
                    </div><br>
                    <div class="form-group">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </div>
            </div>
        </div>
	</form>
@stop

@section('scripts_validator')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".edit-publisher").validate({
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