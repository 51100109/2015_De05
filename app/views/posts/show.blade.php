@extends('posts.main')

@section('title')
  Thông tin bài đăng
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('posts/index')}}"> Bài đăng</a></li>
            <li class="active"> Thông tin bài đăng</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Bài Đăng</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="{{asset('posts/index')}}">Bài đăng</a></li>
                <li><a href="{{asset('posts/delete/0')}}">Xóa bài đăng</a></li>      
                <li  class="active"><a href="{{asset('posts/show')}}">Thông tin bài đăng</a></li>
            </ul>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông Tin Bài Đăng</h3>
                </div>
                <div class="panel-body">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <label>Điều khoản sử dụng</label>
                        <ol>
                            <li>Chọn ID bài đăng muốn xem thông tin</li>
                        </ol>     
                    </div>
                    <div>
                        <form class="well" href="{{asset('posts/show')}}" method="post"> 
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-exclamation-sign" style="padding-left:40px"></span> {{Session::get('fail')}}
                                {{ Session::forget("fail") }}
                            </div>
                        @endif 
                        <p>
                            <label>ID bài đăng</label>
                            <select name='id' id='id' class='form-control'>
                                <option value="0">[ Chọn ID ]</option>
                                @foreach($posttitle as $post)
                                <option value="{{$post->id}}" <?php if(!empty($postcheck)&&($post->id == $postcheck->id)) echo "selected='selected'"; ?>>ID: {{$post->id}}</option>
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