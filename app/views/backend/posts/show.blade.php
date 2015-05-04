@extends('backend.modals.layout_colorbox')

@section('title')
    Thông Tin Bài Đăng
@stop

@section('title_modals')
  Thông tin bài đăng {{ $show->id }}
@stop

@section('hidden')
    <div class="show_hidden">
        <div class="col-xs-1 icon_post"></div>
    </div>
    <div class="hiddenlist">
            <div class="panel panel-primary null">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Bài Đăng</h3>
                </div>
                <div class="panel-body background_EB">
                    <table class="display" id="posts_table_hidden">
                            <thead>
                                <tr>    
                                    <th class="col-xs-1">ID</th>
                                    <th class="col-xs-10">Tiêu Đề</th>
                                    <th class="col-xs-1"></th>
                                </tr>
                            </thead>
                    </table>
                </div>
            </div>
    </div>
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
     <div class="panel panel-primary">
        <div class="panel-heading">
            <form method="POST" action="<?php echo asset("admin/posts/detroy-id/{$show->id}/next"); ?>" style="display:inline">
                <a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa bài đăng" data-message="Bạn chắc chắn muốn xóa bài đăng có ID: {{ $show->id }} ?"><span class="glyphicon glyphicon-trash"></span></a>
            </form>
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
        <div class="row">
                <div class="col-xs-3 text-center">
                    <img src="{{asset('assets/image/posts/post_icon.png')}}" class="image_size300" alt="{{$show->id}}">
                </div>
                <div class="col-xs-9">
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">ID</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->id }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Tiêu đề</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->title }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Người đăng</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">
                            @if(!empty( UserAccount::find($show->id_user)))
                                <a href="{{{ URL::to('admin/user-accounts/information/'.$show->id_user) }}}" class="block">{{ UserAccount::find($show->id_user)->username }}</a>
                            @else
                                [ ... ]
                            @endif
                        </div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Lượt xem</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $view }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Số bình luận</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $number_comments }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Nội dung</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->content }}</div>
                    </div>
                    <div class="text-right">
                    <a href="#" class="block"> Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <form method="POST" action="{{asset('admin/comments/detroy')}}" style="display:inline">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa bình luận" data-message="Bạn chắc chắn muốn xóa các bình luận đã chọn ?"><span class="glyphicon glyphicon-trash"></span></a>
                <h3 class="panel-title">Bình luận trong bài đăng</h3>
            </div>
            <div class="panel-body background_EB">
                <table class="display" id="comments_table">
                    <thead>
                        <tr>
                            <th class="col-xs-1"><div class="icon0"></div></th>
                            <th class="col-xs-1">ID</th>
                            <th class="col-xs-4">Bình Luận</th>
                            <th class="col-xs-2">Người Đăng</th>
                            <th class="col-xs-3">Thời Gian</th>
                            <th class="col-xs-1"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </form>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Hoạt động bài đăng</h3>
        </div>
        <div class="panel-body background_EB">
            <table class="display" id="activities_table">
                <thead>
                    <tr>
                        <th class="col-xs-1"><div class="icon0"></div></th>
                        <th class="col-xs-2">Thành Viên</th>
                        <th class="col-xs-2">Hoạt Động</th>
                        <th class="col-xs-1">ID</th>
                        <th class="col-xs-3">Thông Tin</th>
                        <th class="col-xs-3">Thời Gian</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript">
        var oTable;
        var oTable_hidden;
        var oTable_activities;
        var length = window.innerHeight * 0.7;

        $(document).ready(function() {
            oTable =   $('#comments_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 1, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/comments/comment-item/posts/'.$show->id) }}",
                "language": {
                    "url":"{{asset('assets/data-table/language/comments.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            }); 

           oTable_hidden =   $('#posts_table_hidden').dataTable({
                "sDom": "<'row'<'col-md-12'f>r>t<'row'<'col-md-12'p>>",
                "bLengthChange": false,
                "bInfo" : false,
                "order": [[ 0, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/posts/data-hidden') }}",
                "language": {
                    "url":"{{asset('assets/data-table/language/posts.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            }); 

            oTable_activities =   $('#activities_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/activities/data-post/'.$show->id) }}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop