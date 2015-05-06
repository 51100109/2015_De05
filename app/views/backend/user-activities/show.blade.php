
@extends('backend.modals.layout_colorbox')

@section('title')
    Thông tin hoạt động
@stop

@section('title_modals')
    <li class="previous"><a onclick="goBack()">Back</a></li>
    <li class="title slogan">Thông tin hoạt động {{ $show->id }}</li>
    <li class="next"><a onclick="goForward()">Forward</a></li>
@stop

@section('modals')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Thông Tin</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <img src="{{asset('assets/image/activities/activity.png')}}" class="image_size300" alt="{{$show->id}}">
                </div>
                <div class="col-xs-8">
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">ID</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->id }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Người thực hiện</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">
                            @if(!empty( UserAccount::find($show->id_user)))
                                <a href="{{{ URL::to('admin/user-accounts/information/'.$show->id_user) }}}" class="block">{{ UserAccount::find($show->id_user)->username }}</a>
                            @else
                                [ ... ]
                            @endif
                        </div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Hoạt động</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->activity }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">{{ $show->target }}</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">
                            @if(($show->target == 'Nhà phát hành')&&(!empty(Publisher::find($show->id_target))))
                                <a href="{{{ URL::to('admin/publishers/information/'.$show->id_target) }}}" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                            @elseif(($show->target == 'Danh mục')&&(!empty(Category::find($show->id_target))))
                                <a href="{{{ URL::to('admin/categories/information/'.$show->id_target) }}}" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                            @elseif(($show->target == 'Hệ điều hành')&&(!empty(OperateSystem::find($show->id_target))))
                                <a href="{{{ URL::to('admin/operate-systems/information/'.$show->id_target) }}}" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                            @elseif(($show->target == 'Phần mềm')&&(!empty(Software::find($show->id_target))))
                                <a href="{{{ URL::to('admin/softwares/information/'.$show->id_target) }}}" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                            @elseif(($show->target == 'Thành viên')&&(!empty(UserAccount::find($show->id_target))))
                                <a href="{{{ URL::to('admin/user-accounts/information/'.$show->id_target) }}}" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                            @elseif(($show->target == 'Bài đăng')&&(!empty(Post::find($show->id_target))))
                                <a href="{{{ URL::to('admin/posts/information/'.$show->id_target) }}}" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                            @elseif(($show->target == 'Bình luận')&&(!empty(Comment::find($show->id_target))))
                                <a href="{{{ URL::to('admin/comments/information/'.$show->id_target) }}}" class="block"> {{ $show->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                            @else
                                {{ $show->id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                            @endif
                        </div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Thông tin</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->infor }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Thời gian</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->created_at }}</div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
@stop    
