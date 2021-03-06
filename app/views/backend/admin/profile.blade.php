@extends('backend.modals.layout_colorbox')

@section('title')
    Cập Nhật Thông Tin Cá Nhân
@stop

@section('title_modals')
    <div class="title slogan">{{ $user->username }}</div>
@stop

@section('modals')
	<form method="POST" action="{{{ URL::to('admin/user-accounts/edit-admin/'.$user->id) }}}" class="container edit-user"> 
            <div class="row">
                <div class="col-xs-4">
                    <img src="{{asset('assets/image/users/administartor.png')}}" class="image_size300" alt="{{$user->username}}">        
                </div>
                <div class="col-xs-7">
                                <div class="form-group">
                                    <label class="control-label" for="id">ID</label> 
                                    <input type="text" name="id" id="id" value="{{ $user->id }}" class="form-control" disabled/>
                                </div>                
                                <div class="form-group">
                                    <label class="control-label" for="username">Tên tài khoản</label> 
                                    <input type="text" name="username" id="username"  value="{{ $user->username }}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="admin">Quyền sử dụng</label> 
                                    <select name="admin" id="admin" class="form-control">
                                            <option value="">Quyền sử dụng</option>
                                            <option value="0" <?php if($user->admin == 0) echo "selected='selected'"; ?>>Thành viên</option>
                                            <option value="1" <?php if($user->admin == 1) echo "selected='selected'"; ?>>Administrator</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Mật khẩu</label>
                                    <input type="password" name="password" id="password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password_confirmation">Nhập lại mật khẩu</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="email" name="email" id="email"  value="{{ $user->email }}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="fullname">Họ và tên</label>
                                    <input type="text" name="fullname" id="fullname" value="{{ $user->fullname }}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="creenname">Tên hiển thị</label>
                                    <input type="text" name="creenname" id="creenname" value="{{ $user->creenname }}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="gender">Giới tính</label>
                                    <select name="gender" id="gender" class="form-control">
                                            <option value="">Giới tính </option>
                                            <option value="1" <?php if($user->gender == "Nam") echo "selected='selected'"; ?>>Nam</option>
                                            <option value="2" <?php if($user->gender == "Nữ") echo "selected='selected'"; ?>>Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="birthday">Ngày sinh</label>
                                       <input type="date" name="birthday" id="birthday" value="{{ $user->birthday }}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="address">Địa chỉ</label>
                                    <input type="text" name="address" id="address" value="{{ $user->address }}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="phone">Điện thoại</label>
                                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control"/>
                                </div><br>
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
            $(".edit-user").validate({
          rules:{
            username:{
              required:true,
              minlength:3,
              remote:{
                url: "{{{ URL::to('admin/user-accounts/check-editusername/'.$user->id) }}}",
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
                url:"{{{ URL::to('admin/user-accounts/check-editemail/'.$user->id) }}}",
                type: "POST"
              }
            },
            fullname:{
              required:true,
              remote:{
                url: "{{{ URL::to('admin/user-accounts/check-fullname') }}}",
                type: "POST"
              }
            },
            creenname:{
              required:true,
              remote:{
                url: "{{{ URL::to('admin/user-accounts/check-creenname') }}}",
                type: "POST"
              }
            },
            birthday:{
              required:true,
            },
            address:{
              required:true,
              remote:{
                url: "{{{ URL::to('admin/user-accounts/check-address') }}}",
                type: "POST"
              }
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
              remote:"Tài khoản đã tồn tại hoặc không hợp lệ"
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
              required:"Vui lòng nhập họ và tên",
              remote:"Họ và tên không hợp lệ"
            },
            creenname:{
              required:"Vui lòng nhập tên hiển thị",
              remote:"Tên hiển thị không hợp lệ"
            },
            birthday:{
              required:"Vui lòng nhập ngày sinh"
            },
            address:{
              required:"Vui lòng nhập địa chỉ",
              remote:"Địa chỉ không hợp lệ"
            },
            phone:{
              required:"Vui lòng nhập số điện thoại",
              number:"Số điện thoại không đúng định dạng",
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