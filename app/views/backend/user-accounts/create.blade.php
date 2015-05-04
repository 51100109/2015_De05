@extends('backend.modals.layout_colorbox')

@include('backend.user-accounts.hidden')

@section('title')
    Thêm Thành Viên
@stop

@section('title_modals')
    Thêm thành viên
@stop

@section('modals')
              @include('backend.modals.delete_confirm')
                    <form method="POST" action="{{asset('admin/user-accounts/create')}}" class="form-horizontal register-user"> 
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="username">Tên tài khoản</label> 
                                    <div class="col-xs-8">
                                        <input type="text" name="username" id="username" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="admin">Quyền sử dụng</label> 
                                    <div class="col-xs-8">
                                        <select name="admin" id="admin" class="form-control">
                                            <option value="">Quyền sử dụng</option>
                                            <option value="0">Thành viên</option>
                                            <option value="1">Administrator</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="password">Mật khẩu</label>
                                    <div class="col-xs-8">
                                        <input type="password" name="password" id="password" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="password_confirmation">Nhập lại mật khẩu</label>
                                    <div class="col-xs-8">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="email">Email</label>
                                    <div class="col-xs-8">
                                        <input type="email" name="email" id="email" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="fullname">Họ và tên</label>
                                    <div class="col-xs-8">
                                        <input type="text" name="fullname" id="fullname" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="creenname">Tên hiển thị</label>
                                    <div class="col-xs-8">
                                        <input type="text" name="creenname" id="creenname"  class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="gender">Giới tính</label>
                                    <div class="col-xs-8">
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Giới tính </option>
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="birthday">Ngày sinh</label>
                                    <div class="col-xs-8"> 
                                       <input type="date" name="birthday" id="birthday" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="address">Địa chỉ</label>
                                    <div class="col-xs-8"> 
                                        <input type="text" name="address" id="address" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="phone">Điện thoại</label>
                                    <div class="col-xs-8">
                                       <input type="text" name="phone" id="phone" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-11 text-right">
                                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                                        <button type="reset" class="btn btn-warning">Tạo lại</button>
                                    </div>
                                </div>
                    </form>
    
@stop

@section('scripts_validator')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".register-user").validate({
          rules:{
            username:{
              required:true,
              minlength:3,
              remote:{
                url: "{{asset('admin/user-accounts/check-username')}}",
                type: "POST"
              }
            },
            password:{
              required:true,
              minlength:6
            },
            password_confirmation:{
              required:true,
              equalTo:"#password"
            },
            email:{
              required:true,
              email:true,
              remote:{
                url:"{{asset('admin/user-accounts/check-email')}}",
                type: "POST"
              }
            },
            fullname:{
              required:true,
            },
            creenname:{
              required:true,
            },
            birthday:{
              required:true,
            },
            address:{
              required:true,
            },
            phone:{
              required:true,
              number:true,
            },
            gender:{
              required:true,
            },
            admin:{
              required:true,
            },
          },
          messages:{
            username:{
              required:"Vui lòng nhập tên tài khoản",
              minlength:"Tên tài khoản phải có 3 ký tự trở lên",
              remote:"Tài khoản đã tồn tại"
            },
            password:{
              required:"Vui lòng nhập mật khẩu",
              minlength:"Mật khẩu phải có 6 ký tự trở lên"
            },
            password_confirmation:{
              required:"Vui lòng xác nhận mật khẩu",
              equalTo:"Mật khẩu xác nhận không đúng"
            },
            email:{
              required:"Vui lòng nhập Email",
              email:"Định đạng Email không đúng",
              remote:"Email đã được sử dụng"
            },
            fullname:{
              required:"Vui lòng nhập họ và tên"
            },
            creenname:{
              required:"Vui lòng nhập tên hiển thị"
            },
            birthday:{
              required:"Vui lòng nhập ngày sinh"
            },
            address:{
              required:"Vui lòng nhập địa chỉ"
            },
            phone:{
              required:"Vui lòng nhập số điện thoại",
              number:"Số điện thoại không đúng định dạng"
            },
            gender:{
              required:"Vui lòng chọn giới tính",
            },
            admin:{
              required:"Vui lòng chọn quyền sử dụng",
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