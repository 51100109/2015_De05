@extends('softwares.main')

@section('title')
  Thông tin phần mềm
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('softwares/index')}}"> Phần mềm</a></li>
            <li><a href="{{asset('softwares/show')}}"> Thông tin phần mềm</a></li>
            <li class="active">{{ $show->name }}</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Phần Mềm</h2>
    </div>
    <div class="row"> 
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="{{asset('softwares/index')}}">Phần mềm</a></li>
                <li><a href="{{asset('softwares/create')}}">Thêm phần mềm</a></li>
                <li><a href="{{asset('softwares/edit/0')}}">Chỉnh sửa phần mềm</a></li>
                <li><a href="{{asset('softwares/delete/0')}}">Xóa phần mềm</a></li>      
                <li  class="active"><a href="{{asset('softwares/show')}}">Thông tin phần mềm</a></li>
            </ul>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông Tin Phần Mềm</h3>
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
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Phần mềm</th>
                                    <td class="colonwidth">:</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                        <a href="#" class="block"> Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bình luận trong bài đăng</h3>
                    </div>
                    @if ($comments->count())
                    <div class="panel-body">
                        <table class="table table-hover tablesorter">
                            <thead>
                                <tr>    
                                    <th>ID</th>
                                    <th>Người Đăng</th>
                                    <th>Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                <tr >
                                    <td style="width:50px">
                                        @if(!empty( Comment::find($comment->id)))
                                            <a href="<?php echo asset("comments/information/{$comment->id}"); ?>" class="block"> {{ $comment->id }} <span class="glyphicon glyphicon-link"></span></a>
                                        @else
                                            {{ $comment->id }} <span class="glyphicon glyphicon-remove-circle"></span>
                                        @endif
                                    </td>
                                    <td style="width:160px">
                                        @if(!empty( UserAccount::find($comment->id_user)))
                                            <a href="<?php echo asset("user-accounts/information/{$comment->id_user}"); ?>" class="block">{{ UserAccount::find($comment->id_user)->username }}</a>
                                        @else
                                            [ Không tồn tại ]
                                        @endif
                                    </td>
                                    <td>{{ $comment->content }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{$comments->links()}}
                        </div>
                    </div>
                    @else
                        <div class="panel-body">
                            Chưa có thông tin.
                        </div>
                    @endif
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hoạt động với phần mềm</h3>
                    </div>

                    @if ($activities->count())
                    <div class="panel-body">
                        <table class="table table-hover tablesorter">
                            <thead>
                                <tr>   
                                    <th>Thành viên</th>
                                    <th>Hoạt Động</th>
                                    <th>Thông Tin</th>
                                    <th>Thời Gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $log)
                                <tr>
                                    <td>
                                        @if(!empty( UserAccount::find($log->id_user)))
                                            <a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username }}</a>
                                        @else
                                            [ Không tồn tại ]
                                        @endif
                                    </td>
                                    <td>{{ $log->activity }}</td>
                                    <td>{{ $log->infor }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{$activities->links()}}
                        </div>
                    </div>
                    @else
                        <div class="panel-body">
                            Chưa có thông tin.
                        </div>
                    @endif
                </div>
            </div>
        </div>
@stop