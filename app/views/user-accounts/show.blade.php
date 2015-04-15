@extends('user-accounts.main')

@section('title')
  Thông tin nhà phát hành
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('user-accounts/index')}}"> Thành viên</a></li>
            <li class="active"> Thông tin thành viên</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Thành Viên</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="{{asset('user-accounts/index')}}">Thành viên</a></li>
                <li><a href="{{asset('user-accounts/create')}}">Thêm thành viên</a></li>     
                <li><a href="{{asset('user-accounts/delete/0')}}">Xóa thành viên</a></li>      
                <li  class="active"><a href="{{asset('user-accounts/show')}}">Thông tin thành viên</a></li>
            </ul>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông Tin Thành Viên</h3>
                </div>
                <div class="panel-body">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <label>Điều khoản sử dụng</label>
                        <ol>
                            <li>Chọn tên tài khoản muốn xem thông tin</li>
                        </ol>     
                    </div>
                    <div>
                        <form class="well" href="{{asset('user-accounts/show')}}" method="post"> 
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-exclamation-sign" style="padding-left:40px"></span> {{Session::get('fail')}}
                                {{ Session::forget("fail") }}
                            </div>
                        @endif 
                        <p>
                            <label>Tên tài khoản</label>
                            <select name='id' id='id' class='form-control'>
                                <option value="0">[ Chọn tài khoản ]</option>
                                @foreach($username as $user)
                                <option value="{{$user->id}}" <?php if(!empty($usercheck)&&($user->id == $usercheck->id)) echo "selected='selected'"; ?>>{{$user->username}} - ID: {{$user->id}}</option>
                                @endforeach
                            </select>
                        </p>
                        <p><button class="btn btn-default">Xác nhận</button></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop