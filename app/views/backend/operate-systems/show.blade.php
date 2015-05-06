@extends('backend.modals.layout_colorbox')

@section('title')
  Thông Tin Hệ Điều Hành
@stop

@section('title_modals')
    <li class="previous"><a onclick="goBack()">Back</a></li>
    <li class="title slogan"><img src="{{ $show->image }}" class="size40" alt="icon"> {{ $show->name }}</li>
    <li class="next"><a onclick="goForward()">Forward</a></li>
@stop

@section('modals')
    @include('backend.modals.delete_confirm')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <form method="POST" action="{{{ URL::to('admin/operate-systems/detroy-id/'.$show->id.'/next') }}}" style="display:inline">
                <a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa hệ điều hành" data-message="Bạn chắc chắn muốn xóa hệ điều hành có ID: {{ $show->id }} ?"><span class="glyphicon glyphicon-trash"></span></a>
            </form>
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
           
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">ID</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->id }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Hệ điều hành</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->name }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Ngày Tạo</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{ $show->created_at }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-2 color0">Danh mục</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9 null">
                            @foreach(explode("\n",$show->id_category) as $item)
                            <div class="col-xs-6">
                                @if(!empty(Category::find($item)))
                                    <a href="{{{ URL::to('admin/categories/information/' . $item) }}}" class="block show_info"><img src="{{ Category::find($item)->image }}" class="size30" alt="icon"> {{ Category::find($item)->name }}</a>
                                @else
                                    [ ... ]
                                @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
           
    </div>
    
   <form method="POST" action="{{{ URL::to('admin/softwares/detroy') }}}" style="display:inline">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa phần mềm" data-message="Bạn chắc chắn muốn xóa các phần mềm đã chọn ?"><span class="glyphicon glyphicon-trash"></span></a>
                        <h3 class="panel-title">Danh Sách Phần Mềm</h3>
                    </div>
                    <div class="panel-body background_EB">
                        <table id="softwares_table" class="display" >
                            <thead>
                                <tr>    
                                    <th class="col-xs-1"><div class="icon0"></div></th>
                                    <th class="col-xs-1">ID</th>
                                    <th class="col-xs-3">Phần Mềm</th>
                                    <th class="col-xs-2">Nhà Phát Hành</th>
                                    <th class="col-xs-3">Danh Mục</th>
                                    <th class="col-xs-1"></th>
                                    <th class="col-xs-1"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
    </form>

    <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Hoạt động hệ điều hành</h3>
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
        var oTable;
        var oTable_activities;
        var length = window.innerHeight * 0.7;

        $(document).ready(function() {
            oTable =   $('#softwares_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 1, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{{ URL::to('admin/softwares/data-system/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/softwares.json')}}",
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
                "sAjaxSource": "{{{ URL::to('admin/activities/data-system/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop