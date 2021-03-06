@extends('backend.modals.layout_colorbox')

@section('title')
    Thông Tin Thành Viên
@stop

@section('title_modals')
    <li class="previous"><a onclick="goBack()">Back</a></li>
    <li class="title slogan">Thông tin thành viên {{ $show->username }}</li>
    <li class="next"><a onclick="goForward()">Forward</a></li>
@stop

@section('modals')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a class="close deleteWhite delete_info_entry_close em1_4" href="{{{ URL::to('admin/user-accounts/delete/' . $show->id) }}}"><span class="glyphicon glyphicon-trash"></span></a>
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    @if($show->admin == 1)
                        <img src="{{asset('assets/image/users/administartor.png')}}" class="image_size300" alt="{{$show->username}}">
                    @elseif($show->gender == 'Nam')
                        <img src="{{asset('assets/image/users/male.png')}}" class="image_size300" alt="{{$show->username}}">
                    @else
                        <img src="{{asset('assets/image/users/female.png')}}" class="image_size300" alt="{{$show->username}}">
                    @endif
                </div>
                <div class="col-xs-8">
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">ID</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->id }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Tài khoản</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->username }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Admin</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">
                            @if($show->admin == 1)
                                <span class="glyphicon glyphicon-ok"></span>
                            @else
                                <span class="glyphicon glyphicon-minus"></span>
                            @endif
                        </div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Tên thành viên</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->fullname }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Tên hiển thị</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->creenname }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Giới tính</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->gender }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Email</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->email }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Ngày sinh</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->birthday }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Địa chỉ</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->address }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Điện thoại</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->phone }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Ngày Tạo</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->created_at }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Cập nhật lần cuối</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $show->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        $(document).ready(function() {
            oTable_activities =   $('#activities_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{{ URL::to('admin/activities/data-user/'.$show->id) }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
            });                       
    });
    </script>
@stop