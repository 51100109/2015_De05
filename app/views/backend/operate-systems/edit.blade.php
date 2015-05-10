@extends('backend.modals.layout_colorbox')

@section('title')
    Cập Nhật Hệ Điều Hành
@stop

@section('title_modals')
    <div class="title slogan"><img src="{{ $system->image }}" class="size40" alt="icon"> {{ $system->name }}</div>
@stop

@section('modals')
	<form method="POST" action="{{{ URL::to('admin/operate-systems/edit/'.$system->id) }}}" class="container edit-system"> 
        <div class="row">
                <div class="col-xs-3">
                    <img src="{{asset('assets/image/systems/system_edit.png')}}" class="image_size300" alt="{{$system->id}}">          
                </div>
                <div class="col-xs-8">
                    <div class="form-group">
                        <label class="control-label" for="id">ID</label> 
                        <input type="text" name="id" id="id" value="{{ $system->id }}" class="form-control" disabled/>
                    </div>                
                    <div class="form-group">
                        <label class="control-label" for="name">Tên hệ điều hành</label> 
                        <input type="text" name="name" id="name" value="{{ $system->name }}" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="image">Hình ảnh</label> 
                        <input type="text" name="image" id="image" class="form-control" value="{{ $system->image }}" />
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 control-label null" for="id_category">Danh mục</label><br>
                        @foreach($category as $item)
                            <div class="col-xs-12 col-sm-6 margin10_top">
                                <input type="checkbox" name="id_category[]" id="id_category" value="{{ $item->id }}" class="close check_box_20" style="float:left"
                                     <?php
                                        foreach (explode("\n",$system->id_category) as $checked){
                                            if($checked == $item->id) echo "checked='checked'"; 
                                        }
                                     ?>
                                />
                                <img src="{{ $item->image }}" class="size30 margin_left20" alt="icon"> {{ $item->name }}
                            </div>
                        @endforeach
                    </div><br>
                    <div class="form-group">
                        <div class="col-xs-12 text-right margin10_top">
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
            $(".edit-system").validate({
                rules:{
                    name:{
                        required:true,
                        remote:{
                            url: "{{{ URL::to('admin/operate-systems/check-editname/'.$system->id) }}}",
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