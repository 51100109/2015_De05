@extends('backend.modals.layout_colorbox')

@include('backend.softwares.hidden')

@section('title')
    Thông Tin Phần Mềm
@stop

@section('title_modals')
    <img src="{{ $show->image }}" class="size40" alt="icon"> {{ $show->name }}
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <form method="POST" action="<?php echo asset("admin/softwares/detroy-id/{$show->id}/next"); ?>" style="display:inline">
                <a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa phần mềm" data-message="Bạn chắc chắn muốn xóa phần mềm {{ $show->username}} có ID: {{ $show->id }} ?"><span class="glyphicon glyphicon-trash"></span></a>
            </form>
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
            <div class="row rowbody">
                <div class="col-xs-3 color0">ID</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">{{ $show->id }}</div>
            </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Tên phần mềm</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">{{ $show->name }}</div>
            </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Dung lượng</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">{{ $show->filesize }} MB</div>
            </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Tải về</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8"><a href="{{ $show->download }}" class="block">{{ $show->download }}</a></div>
            </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Ngôn ngữ</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">{{ $show->language }}</div>
            </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Sử dụng</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">{{ $show->license }}</div>
            </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Danh mục</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">
                    @if(!empty($item = Category::find($show->id_category)))
                        <a href="{{{ URL::to('admin/categories/information/'.$show->id_category) }}}" class="block"><img src="{{ $item->image }}" class="size30" alt="icon"> {{ $item->name }}</a>
                    @else
                        [ ... ]
                    @endif
                </div>
            </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Hệ điều hành</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">
                    @if(!empty($item = OperateSystem::find($show->id_system)))
                        <a href="{{{ URL::to('admin/publishers/information/'.$show->id_publisher) }}}" class="block"><img src="{{ $item->image }}" class="size30" alt="icon"> {{ $item->name }}</a>
                    @else
                        [ ... ]
                    @endif
                </div>
             </div>
            <div class="row rowbody">
                <div class="col-xs-3 color0">Nhà phát hành</div>
                <div class="col-xs-1">:</div>
                <div class="col-xs-8">
                    @if(!empty($item = Publisher::find($show->id_publisher)))
                        <a href="{{{ URL::to('admin/categories/information/'.$show->id_category) }}}" class="block">{{ $item->name }}</a>
                    @else
                        [ ... ]
                    @endif
                </div>
            </div>
            <div class="col-xs-12">{{ $show->description }}</div>
        </div>
    </div>
    
    <form method="POST" action="{{asset('admin/comments/detroy')}}" style="display:inline">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa bình luận" data-message="Bạn chắc chắn muốn xóa các bình luận đã chọn ?"><span class="glyphicon glyphicon-trash"></span></a>
                <h3 class="panel-title">Bình luận trong phần mềm</h3>
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
                    <h3 class="panel-title">Hoạt động</h3>
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

@section('scripts_activities')
    <script type="text/javascript">
        var oTable;
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

            oTable_activities =   $('#activities_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/activities/data-software/'.$show->id) }}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop