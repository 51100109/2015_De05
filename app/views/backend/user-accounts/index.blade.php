@extends('backend.admin.index')

@section('title')
	Thành Viên
@stop

@section('breadcrumbs')
	<ol class="breadcrumb null margin_left10">
	  <li><a href="{{{ URL::to('admin/home') }}}" class="block">Trang chủ</a></li>
	  <li class="active">Quản lý thành viên</li>
	  <li class="active">Thành viên</li>
	</ol>
@stop

@section('content')
	@include('backend.modals.delete_confirm')
	<div class="width50_bottom10">
 		<a class="close add_info" href="{{{ URL::to('admin/user-accounts/create') }}}"><img src="{{asset('assets/image/background/add_icon.png')}}" class="image_size300" alt="add"></a>
 	</div>
	<div class="row">
		<div class="col-xs-12">
			<form method="POST" action="{{{ URL::to('admin/user-accounts/detroy') }}}" style="display:inline">
				<div class="panel panel-primary">
			        <div class="panel-heading">
						<a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa thành viên" data-message="Bạn chắc chắn muốn xóa các thành viên đã chọn ?"><span class="glyphicon glyphicon-trash"></span></a>
			            <h3 class="panel-title">Danh Sách Administrator</h3>
			        </div>
					<div class="panel-body background_EB">
						<table id="admins_table" class="display" >
							<thead>
								<tr>    
									<th class="col-xs-1"><div class="icon0"></div></th>
								    <th class="col-xs-1">ID</th>
									<th class="col-xs-3">Tài Khoản</th>
									<th class="col-xs-3">Họ và Tên</th>
									<th class="col-xs-2">Tên Hiển Thị</th>
									<th class="col-xs-1"></th>
									<th class="col-xs-1"></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</form>
			<form method="POST" action="{{{ URL::to('admin/user-accounts/detroy') }}}" style="display:inline">
				<div class="panel panel-primary">
			        <div class="panel-heading">
						<a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa thành viên" data-message="Bạn chắc chắn muốn xóa các thành viên đã chọn ?"><span class="glyphicon glyphicon-trash"></span></a>
			            <h3 class="panel-title">Danh Sách Thành Viên</h3>
			        </div>
					<div class="panel-body background_EB">
						<table id="members_table" class="display" >
							<thead>
								<tr>    
									<th class="col-xs-1"><div class="icon0"></div></th>
								    <th class="col-xs-1">ID</th>
									<th class="col-xs-3">Tài Khoản</th>
									<th class="col-xs-3">Họ và Tên</th>
									<th class="col-xs-2">Tên Hiển Thị</th>
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
				    <h3 class="panel-title">Hoạt Động Administrator</h3>
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
		</div>
	</div>
	
@stop

@section('scripts')
	<script type="text/javascript">   
        function updatetable(){
        	parent.oTable.fnReloadAjax();
            parent.oTable2.fnReloadAjax();
            parent.oTable_activities.fnReloadAjax();
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
            oTable =   $('#admins_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 1, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{{ URL::to('admin/user-accounts/data/1') }}}",
		 		"language": {
		            "url":"{{asset('assets/data-table/language/users.json')}}",
		            "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		            "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		        },
		       	"fnDrawCallback": colorbox_show,
        	});

        	oTable2=   $('#members_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 1, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{{ URL::to('admin/user-accounts/data/0') }}}",
		        "language": {
		            "url":"{{asset('assets/data-table/language/users.json')}}",
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
		        "sAjaxSource": "{{{ URL::to('admin/activities/data-user/0') }}}",
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