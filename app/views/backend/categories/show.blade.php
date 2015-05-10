@extends('backend.modals.layout_colorbox')

@section('title')
  Thông Tin Danh Mục Phần Mềm
@stop

@section('title_modals')
    <li class="previous"><a onclick="goBack()">Back</a></li>
    <li class="title slogan"><img src="{{ $show->image }}" class="size40" alt="icon"> {{ $show->name }}</li>
    <li class="next"><a onclick="goForward()">Forward</a></li>
@stop

@section('modals')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a class="close deleteWhite delete_info_entry_close em1_4" href="{{{ URL::to('admin/categories/delete/' . $show->id) }}}"><span class="glyphicon glyphicon-trash"></span></a>
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 text-center">
                    <img src="{{asset('assets/image/categories/category_view.png')}}" class="image_size300" alt="{{$show->id}}">
                </div>
                <div class="col-xs-9">
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">ID</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->id }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Danh mục</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->name }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Ngày tạo</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->created_at }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Cập nhật lần cuối</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->updated_at }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Số Phần mềm</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ Software::where("id_category","=",$show->id)->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách phần mềm</h3>
                    </div>
                    <div class="panel-body background_EB">
                        <table id="softwares_table" class="display" >
                            <thead>
                                <tr>    
                                    <th class="col-xs-1"><div class="icon0"></div></th>
                                    <th class="col-xs-1">ID</th>
                                    <th class="col-xs-3">Phần Mềm</th>
                                    <th class="col-xs-2">Hệ Điều Hành</th>
                                    <th class="col-xs-3">Nhà Phát Hành</th>
                                    <th class="col-xs-1"></th>
                                    <th class="col-xs-1"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
    </div>

    <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Hoạt động Administrator</h3>
            </div>
            <div class="panel-body background_EB">
                    <table class="display" id="activities_table">
                        <thead>
                            <tr>
                                <th class="col-xs-1"><div class="icon0"></div></th>
                                <th class="col-xs-2">Admin</th>
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
            oTable =   $('#softwares_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 1, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{{ URL::to('admin/softwares/data-category/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/softwares.json')}}",
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
                "sAjaxSource": "{{{ URL::to('admin/activities/data-category/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop