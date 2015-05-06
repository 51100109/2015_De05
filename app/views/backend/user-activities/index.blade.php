@extends('backend.admin.index')

@section('title')
	Hoạt động
@stop

@section('breadcrumbs')
    <ol class="breadcrumb null margin_left10">
      <li><a href="{{{ URL::to('admin/home') }}}" class="block">Trang chủ</a></li>
      <li class="active">Quản lý thành viên</li>
      <li class="active">Hoạt động</li>
    </ol>
@stop

@section('content')  
    <div class="row">
        <div class="col-xs-12">
			<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Tất cả hoạt động - Administrator</h3>
                </div>    
                <div class="panel-body background_EB">
                    <table class="display" id="activities_admin_table">
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
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Tất cả hoạt động - Thành viên</h3>
                </div>
                <div class="panel-body background_EB">
                    <table class="display" id="activities_member_table">
                        <thead>
                            <tr>   
                            	<th class="col-xs-1"><div class="icon0"></div></th>
                                <th class="col-xs-2">Thành viên</th>
                                <th class="col-xs-2">Hoạt Động</th>
                                <th class="col-xs-2">Đối Tượng</th>
                                <th class="col-xs-1">ID</th>
                                <th class="col-xs-2">Thông Tin</th>
                                <th class="col-xs-2">Thời Gian</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
	<script type="text/javascript">    
        function updatetable(){
            parent.oTable_activities_admin.fnReloadAjax();
            parent.oTable_activities_member.fnReloadAjax();
            $.ajax({
                  url:  "{{{ URL::to('admin/reload-toolpanel') }}}",
                  type:"POST",
                  success: toolpanel,
            });
            $.ajax({
                  url:  "{{{ URL::to('admin/reload-toolbar') }}}",
                  type:"POST",
                  success: toolbar,
            });
        }

		$(document).ready(function() {
            oTable_activities_admin =   $('#activities_admin_table').dataTable({
        	 	"scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 6, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/activities/data/1') }}",
		        "language": {
		            "url":"{{asset('assets/data-table/language/activities.json')}}",
		            "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		            "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		        },
		       	"fnDrawCallback": colorbox_activity,
        	});    

        oTable_activities_member =   $('#activities_member_table').dataTable({
        	 	"scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 6, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/activities/data/0') }}",
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