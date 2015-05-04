@extends('backend.modals.layout_colorbox')

@include('backend.softwares.hidden')

@section('title')
    Cập Nhật Phần Mềm
@stop

@section('title_modals')
    <img src="{{ $software->image }}" class="size40" alt="icon"> {{ $software->name }}
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
	               <form method="POST" action="<?php echo asset("admin/softwares/edit/{$software->id}"); ?>" class="container edit-software"> 
                                <div class="form-group col-xs-12">
                                    <label class="control-label" for="name">ID</label> 
                                    <input type="text" name="id" id="id" value="{{ $software->id }}" class="form-control" disabled />
                                </div>                                
                                <div class="form-group col-xs-12">
                                    <label class="control-label" for="name">Tên phần mềm</label> 
                                    <input type="text" name="name" id="name" value="{{ $software->name }}" class="form-control"/>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label class="control-label" for="image">Hình ảnh</label> 
                                    <input type="text" name="image" id="image" class="form-control" value="{{ $software->image }}" />
                                </div> 
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label class="control-label" for="download">Tải về</label> 
                                    <input type="text" name="download" id="download" class="form-control" value="{{ $software->download }}" />
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" for="filesize">Dung lượng</label> 
                                        <div class="input-group">
                                            <span class="input-group-addon">MB</span>
                                            <input type="text" name="filesize" id="filesize" value="{{ $software->filesize }}" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="language">Ngôn ngữ</label> 
                                        <select name="language" id="language" class="form-control">
                                                <option value="">Ngôn ngữ</option>
                                                <option value="1" <?php if($software->language == "Tiếng Anh") echo "selected='selected'"; ?>>Tiếng Anh</option>
                                                <option value="2" <?php if($software->language == "Tiếng Việt") echo "selected='selected'"; ?>>Tiếng Việt</option>
                                                <option value="3" <?php if($software->language == "Đa ngôn ngữ") echo "selected='selected'"; ?>>Đa ngôn ngữ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="license">Sử dụng</label> 
                                        <select name="license" id="license" class="form-control">
                                                <option value="">Sử dụng</option>
                                                <option value="1" <?php if($software->license == "Miễn phí") echo "selected='selected'"; ?>>Miễn phí</option>
                                                <option value="2" <?php if($software->license == "Dùng thử") echo "selected='selected'"; ?>>Dùng thử</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" for="id_publisher">Nhà phát hành</label> 
                                        <select name="id_publisher" id="id_publisher" class="form-control">
                                                <option value="">Nhà phát hành</option>
                                                @foreach($publisher as $item)
                                                    <option value="{{ $item->id }}" <?php if($software->id_publisher == $item->id) echo "selected='selected'"; ?>>{{ $item->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="id_system">Hệ điều hành</label> 
                                        <select name="id_system" id="id_system" class="form-control">
                                                <option value="">Hệ điều hành</option>
                                                @foreach($system as $item)
                                                    <option value="{{ $item->id }}" <?php if($software->id_system == $item->id) echo "selected='selected'"; ?>>{{ $item->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="id_category">Danh mục phần mềm</label> 
                                        <select name="id_category" id="id_category" class="form-control">
                                                <option value="">Danh mục</option>
                                
                                                @foreach($system as $item)
                                                        <option value="" class="id_selected"  disabled>{{ $item->name }}</option>
                                                        @foreach(explode("\n",$item->id_category) as $cate)
                                                            <option value="{{ $cate }}" <?php if($software->id_category ==  $cate) echo "selected='selected'"; ?>>{{ Category::find($cate)->name }}</option>
                                                        @endforeach
                                                @endforeach
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group col-xs-12">
                                    <label class="control-label" for="description">Mô tả</label> 
                                    <textarea type="text" name="description" id="description description_text" class="form-control ckeditor" value="{{ $software->description }}"></textarea>
                                </div>
                                <div class="form-group col-xs-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                                        <button type="reset" class="btn btn-warning">Tạo lại</button>
                                    </div>
                                </div>
                    </form>
@stop

@section('scripts_validator')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".edit-software").validate({
          rules:{
            name:{
              required:true,
            },
            filesize:{
              required:true,
              number:true,
            },
            language:{
              required:true,
            },
            license:{
              required:true,
            },
            id_publisher:{
              required:true,
            },
            id_category:{
              required:true,
            },
            id_system:{
              required:true,
            },
            image:{
              required:true,
            }, 
            download:{
              required:true,
            },
            description:{
              required:true,
            },
          },
          messages:{
            name:{
              required:"Vui lòng nhập tên phần mềm",
            },
            filesize:{
              required:"Vui lòng nhập dung lượng phần mềm",
              number:"Dung lượng phần mềm là một số",
            },
            language:{
              required:"Vui lòng chọn ngôn ngữ",
            },
            license:{
              required:"Vui lòng chọn cách sử dụng",
            },
            id_publisher:{
              required:"Vui lòng chọn nhà phát hành",
            },
            id_category:{
              required:"Vui lòng chọn danh mục phần mềm",
            },
            id_system:{
              required:"Vui lòng chọn hệ điều hành hỗ trợ",
            },
            image:{
              required:"Vui lòng thêm hình ảnh phần mềm",
            }, 
            download:{
              required:"Vui lòng nhập liên kết tải phần mềm",
            },
            description:{
              required:"Vui lòng nhập thông tin mô tả phần mềm",
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