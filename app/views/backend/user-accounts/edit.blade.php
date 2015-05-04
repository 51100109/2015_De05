@extends('backend.modals.layout_colorbox')

@include('backend.user-accounts.hidden')

@section('title')
    Thay Đổi Quyền Sử Dụng
@stop

@section('title_modals')
    Thay đổi quyền sử dụng {{ $user->username }}
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
	<form method="POST" action="<?php echo asset("admin/user-accounts/edit/{$user->id}"); ?>" class="container edit-user"> 
            <div class="row">
                <div class="col-xs-4">
                        @if($user->admin == 1)
                            <img src="{{asset('assets/image/users/administartor.png')}}" class="image_size300" alt="{{$user->username}}">
                        @elseif($user->gender == 'Nam')
                            <img src="{{asset('assets/image/users/male.png')}}" class="image_size300" alt="{{$user->username}}">
                        @else
                            <img src="{{asset('assets/image/users/female.png')}}" class="image_size300" alt="{{$user->username}}">
                        @endif           
                </div>
                <div class="col-xs-7">
                    <div class="form-group">
                        <label class="control-label" for="id">ID</label> 
                        <input type="text" name="id" id="id" value="{{ $user->id }}" class="form-control" disabled/>
                    </div>                
                    <div class="form-group">
                        <label class="control-label" for="username">Tên tài khoản</label> 
                        <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="fullname">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" value="{{ $user->fullname }}" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="creenname">Tên hiển thị</label>
                        <input type="text" name="creenname" id="creenname" value="{{ $user->creenname }}" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="admin">Quyền sử dụng</label> 
                        <select name="admin" id="admin" class="form-control">
                            <option value="">Quyền sử dụng</option>
                            <option value="0" <?php if($user->admin == 0) echo "selected='selected'"; ?>>Thành viên</option>
                            <option value="1" <?php if($user->admin == 1) echo "selected='selected'"; ?>>Administrator</option>
                        </select>
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
            $(".edit-user").validate({
                rules:{
                    admin:{
                        required:true,
                    },
                },
                messages:{
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