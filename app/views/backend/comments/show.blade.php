@extends('backend.modals.layout_colorbox')

@section('title')
    Thông Tin Bình Luận
@stop

@section('title_modals')
  Thông tin bình luận {{ $show->id }}
@stop

@section('hidden')
    <div class="show_hidden">
        <div class="col-xs-1 icon_comment"></div>
    </div>
    <div class="hiddenlist">
            <div class="panel panel-primary null">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Bình Luận</h3>
                </div>
                <div class="panel-body background_EB">
                    <table class="display" id="comments_table_hidden">
                        <thead>
                            <tr>    
                                <th class="col-xs-1">ID</th>
                                <th class="col-xs-10">Nội Dung</th>
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
            <form method="POST" action="<?php echo asset("admin/comments/detroy-id/{$show->id}/next"); ?>" style="display:inline">
                <a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa bình luận" data-message="Bạn chắc chắn muốn xóa bình luận có ID: {{ $show->id }} ?"><span class="glyphicon glyphicon-trash"></span></a>
            </form>
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 text-center">
                    <img src="{{asset('assets/image/comments/comment_icon.png')}}" class="image_size300" alt="{{$show->id}}">
                </div>
                <div class="col-xs-9">
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">ID</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->id }}</div>
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
                        <div class="col-xs-2 color0">Đối tượng</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">
                            {{ $show->target }}
                            @if(($show->target == 'Bài đăng')&&(!empty( Post::find($show->id_target))))
                                <a href="{{{ URL::to('admin/posts/information/'.$show->id_target) }}}" class="block"> {{ Post::find($show->id_target)->title }}</a>
                            @elseif(($show->target == 'Phần mềm')&&(!empty( Software::find($show->id_target))))
                                <a href="{{{ URL::to('admin/softwares/information/'.$show->id_target) }}}" class="block"> {{ Software::find($show->id_target)->name }}</a>
                            @else
                                {{ $show->id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                            @endif
                        </div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Nội dung</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->content }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Thời gian</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->created_at }}</div>
                    </div>
                    <div class="text-right">
                        <a href="#" class="block"> Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Hoạt động bình luận</h3>
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
        var oTable_hidden;
        var oTable_activities;
        var length = window.innerHeight * 0.7;

        $(document).ready(function() {
           oTable_hidden =   $('#comments_table_hidden').dataTable({
                "sDom": "<'row'<'col-xs-12'f>r>t<'row'<'col-xs-12'p>>",
                "bLengthChange": false,
                "bInfo" : false,
                "order": [[ 0, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/comments/data-hidden') }}",
                "language": {
                    "url":"{{asset('assets/data-table/language/comments.json')}}",
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
                "sAjaxSource": "{{ URL::to('admin/activities/data-comment/'.$show->id) }}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop