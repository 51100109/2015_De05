@extends('backend.admin.index')

@section('title')
    Trang Chủ
@stop

@section('breadcrumbs')
  <ol class="breadcrumb null margin_left10">
    <li><a href="{{{ URL::to('admin/home') }}}" class="block">Trang chủ</a></li>
  </ol>
@stop

@section('content')
      <div class="alert alert-info alert-dismissable">
          <button type="button" class="close em1_4" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
              <label>Điều khoản sử dụng</label>
          <ol>
              <li>Admin có thể cập nhật các thông tin về phần mềm.</li>
              <li>Admin có thể quản lý bài đăng, bình luận của người dùng</li>
              <li>Admin có thể quản lý tài khoản của người dùng</li>
          </ol>
           
      </div>
      <div class="row">
          <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hoạt Động Gần Đây</h3>
                    </div>
                <div class="panel-body background_EB">
                    <table class="display" id="activities_table">
                        <thead>
                            <tr>   
                                <th class="col-xs-1"><div class="icon0"></div></th>
                                <th class="col-xs-2">Admin</th>
                                <th class="col-xs-2">Hoạt Động</th>
                                <th class="col-xs-2">Đối Tượng</th>
                                <th class="col-xs-1">ID</th>
                                <th class="col-xs-2">Thông Tin</th>
                                <th class="col-xs-2">Thời Gian</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="text-right">
                        <a href="{{asset('admin/activities/index')}}" class="block"> Xem thêm <span class="glyphicon glyphicon-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
             oTable_activities =   $('#activities_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "bPaginate": false,
                "order": [[ 6, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{{ URL::to('admin/activities/data/1') }}}",
                "language": {
                    "url":"{{asset('assets/data-table/language/activities.json')}}",
                    "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                    "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
                },
                "fnDrawCallback": colorbox_activity,
            });                                            
    });
    </script>
@stop