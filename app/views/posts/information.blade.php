@extends('posts.main')

@section('title')
  Thông tin bài đăng
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('posts/index')}}"> Bài đăng</a></li>
            <li><a href="{{asset('posts/show')}}"> Thông tin bài đăng</a></li>
            <li class="active">{{ $show->id }}</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Bài Đăng</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="{{asset('posts/index')}}">Bài đăng</a></li>
                <li><a href="{{asset('posts/delete/0')}}">Xóa bài đăng</a></li>      
                <li class="active"><a href="{{asset('posts/show')}}">Thông tin bài đăng</a></li>
            </ul>
            <br>
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông Tin Bài Đăng</h3>
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
                                    <th class="headerwidth">Tiêu đề</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->title }}</td>
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
                                    <th class="headerwidth">Lượt xem</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ UserActivity::where('id_target','=',$show->id)->where('target','=','Bài đăng')->where('activity','=','Xem thông tin')->count() }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Số bình luận</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ Comment::where('target','=','Bài đăng')->where('id_target','=',$show->id)->count() }}</td>
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
                        <h3 class="panel-title">Hoạt động với bài đăng</h3>
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