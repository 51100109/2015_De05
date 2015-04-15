@extends('comments.main')

@section('title')
  Thông tin bình luận
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('comments/index')}}"> Bình luận</a></li>
            <li><a href="{{asset('comments/show')}}"> Thông tin bình luận</a></li>
            <li class="active">{{ $show->id }}</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Bình Luận</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="{{asset('comments/index')}}">Bình luận</a></li>
                <li><a href="{{asset('comments/delete/0')}}">Xóa bình luận</a></li>      
                <li class="active"><a href="{{asset('comments/show')}}">Thông tin bình luận</a></li>
            </ul>
            <br>
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông Tin Bình Luận</h3>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <label class="success"><span class="glyphicon glyphicon-ok"></span> {{Session::get('success')}}</label>
                                {{ Session::forget("success") }}
                            </div>
                        @endif 
                        <table class="table table-hover tablesorter">
                            <tbody>
                                <tr>
                                    <th class="headerwidth">ID</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->id }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">ID người đăng</th>
                                    <td class="colonwidth">:</td>
                                    <td>
                                        @if(!empty( UserAccount::find($show->id_user)))
                                            <a href="<?php echo asset("user-accounts/information/{$show->id_user}"); ?>" class="block"> {{ $show->id_user }} <span class="glyphicon glyphicon-link"></span></a>
                                        @else
                                            {{ $show->id_user }} <span class="glyphicon glyphicon-remove-circle"></span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Người Đăng</th>
                                    <td class="colonwidth">:</td>
                                    <td>
                                        @if(!empty( UserAccount::find($show->id_user)))
                                            {{ UserAccount::find($show->id_user)->username }}
                                        @else
                                            [ Không tồn tại ]
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">ID Đối Tượng</th>
                                    <td class="colonwidth":</td>
                                    <td>{{ $show->target }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Đối Tượng</th>
                                    <td class="colonwidth":</td>
                                    <td>
                                        @if(($show->target == 'Bài đăng')&&(!empty( Post::find($show->id_target))))
                                            <a href="<?php echo asset("posts/information/{$show->id_target}"); ?>" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($show->target == 'Phần mềm')&&(!empty( Software::find($show->id_target))))
                                            <a href="<?php echo asset("softwares/information/{$show->id_target}"); ?>" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @else
                                            {{ $show->id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Nội dung</th>
                                    <td class="colonwidth":</td>
                                    <td>{{ $show->content }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                        <a href="#" class="block"> Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
@stop