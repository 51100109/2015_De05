@extends('backend.modals.layout_colorbox')

@section('title')
    Thông Tin Phần Mềm
@stop

@section('title_modals')
    <li class="previous"><a onclick="goBack()">Back</a></li>
    <li class="title slogan"><img src="{{ $show->image }}" class="size40" alt="icon"> {{ $show->name }}</li>
    <li class="next"><a onclick="goForward()">Forward</a></li>
@stop

@section('modals')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a class="close deleteWhite delete_info_entry_close em1_4" href="{{{ URL::to('admin/softwares/delete/' . $show->id) }}}"><span class="glyphicon glyphicon-trash"></span></a>
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
                <div class="col-xs-8"><a href="{{{ $show->download }}}" target="_blank">{{ $show->download }}</a></div>
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
            <br>
            <div class="col-xs-12">{{ $show->description }}</div>
            <br>
            <div class="text-right">
                <a href="{{{ URL::to('software/' . $show->id) }}}" class="block" target="_blank"> Đến phần mềm <span class="glyphicon glyphicon-arrow-right"></span></a>
            </div>
        </div>
    </div>
    
    <div class="panel panel-primary">
            <div class="panel-heading">
                <a class="close deleteWhite add_info em1_4" href="{{{ URL::to('admin/comments/create/softwares/'.$show->id) }}}"><span class="glyphicon glyphicon-plus"></span></a>
                <h3 class="panel-title">Bình luận trong phần mềm</h3>
            </div>
            <div class="panel-body background_EB">
                <table class="display" id="comments_table">
                    <thead>
                        <tr>
                            <th class="col-xs-1"><div class="icon0"></div></th>
                            <th class="col-xs-1">ID</th>
                            <th class="col-xs-3">Bình Luận</th>
                            <th class="col-xs-2">Người Đăng</th>
                            <th class="col-xs-3">Thời Gian</th>
                            <th class="col-xs-1"></th>
                            <th class="col-xs-1"></th>
                        </tr>
                    </thead>
                </table>
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

@section('scripts_activities')
    <script type="text/javascript">
        $(document).ready(function() {
            oTable =   $('#comments_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 4, "asc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{{ URL::to('admin/comments/comment-item/softwares/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/comments.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
                "fnDrawCallback": colorbox_show,
            }); 

            oTable_activities =   $('#activities_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{{ URL::to('admin/activities/data-software/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop