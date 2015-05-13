@extends('backend.modals.layout_colorbox')

@section('title')
    Thông Tin Bình Luận
@stop

@section('title_modals')
    <li class="previous"><a onclick="goBack()">Back</a></li>
    <li class="title slogan">Thông tin bình luận {{ $show->id }}</li>
    <li class="next"><a onclick="goForward()">Forward</a></li>
@stop

@section('modals')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a class="close deleteWhite delete_info_entry_close em1_4" href="{{{ URL::to('admin/comments/delete/' . $show->id) }}}"><span class="glyphicon glyphicon-trash"></span></a>
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 text-center">
                    <img src="{{asset('assets/image/comments/comment_icon.png')}}" class="image_size300" alt="{{ $show->id }}">
                </div>
                <div class="col-xs-9">
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">ID</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->id }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Người đăng</div>
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
                        <div class="col-xs-3 color0">Đối tượng</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">
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
                        <div class="col-xs-3 color0">Thời gian</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->created_at }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Cập nhật lần cuối</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->updated_at }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Nội dung</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->content }}</div>
                    </div>
                    <div class="text-right">
                        @if($show->target == 'Bài đăng')
                            <a href="{{{ URL::to('post/' . $show->id_target) }}}" class="block" target="_blank"> Đến bài đăng <span class="glyphicon glyphicon-arrow-right"></span></a>
                        @else
                            <a href="{{{ URL::to('software/' . $show->id_target) }}}" class="block" target="_blank"> Đến phần mềm <span class="glyphicon glyphicon-arrow-right"></span></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Hoạt động thành viên</h3>
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
        $(document).ready(function() {
            oTable_activities =   $('#activities_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{{ URL::to('admin/activities/data-comment/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop