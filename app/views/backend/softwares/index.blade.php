@extends('backend.admin.index')

@section('title')
	Phần Mềm
@stop

@section('breadcrumbs')
	<ol class="breadcrumb null margin_left10">
	  <li><a href="{{{ URL::to('admin/home') }}}" class="block">Trang chủ</a></li>
	  <li class="active">Quản lý phần mềm</li>
	  <li class="active">Phần mềm</li>
	</ol>
@stop

@section('content')
	<div class="width50_bottom10">
 		<a class="close add_info" href="{{{ URL::to('admin/softwares/create') }}}"><img src="{{asset('assets/image/background/add_icon.png')}}" class="image_size300" alt="add"></a>
 	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
			        <div class="panel-heading">
			            <h3 class="panel-title">Danh Sách Phần Mềm</h3>
			        </div>
					<div class="panel-body background_EB">
						<table id="softwares_table" class="display" >
							<thead>
								<tr>    
									<th class="col-xs-1"><div class="icon0"></div></th>
								    <th class="col-xs-1">ID</th>
									<th class="col-xs-2">Phần Mềm</th>
									<th class="col-xs-2">Nhà Phát Hành</th>
									<th class="col-xs-2">Hệ Điều Hành</th>
									<th class="col-xs-2">Danh mục</th>
									<th class="col-xs-1"></th>
									<th class="col-xs-1"></th>
								</tr>
							</thead>
						</table>
					</div>
			</div>
			
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
		$(document).ready(function() {
            oTable =   $('#softwares_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 4, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{{ URL::to('admin/softwares/data') }}}",
		 		"language": {
		            "url":"{{asset('assets/data-table/language/softwares.json')}}",
		            "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		            "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		        },
		       	"drawCallback": colorbox_show,
        	});

             oTable_activities =   $('#activities_table').dataTable({
        	 	"scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{{ URL::to('admin/activities/data-software/0') }}}",
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