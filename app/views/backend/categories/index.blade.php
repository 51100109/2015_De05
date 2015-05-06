@extends('backend.admin.index')

@section('title')
	Danh Mục Phần Mềm
@stop

@section('breadcrumbs')
	<ol class="breadcrumb null margin_left10">
	  <li><a href="{{{ URL::to('admin/home') }}}" class="block">Trang chủ</a></li>
	  <li class="active">Quản lý phần mềm</li>
	  <li class="active">Danh mục</li>
	</ol>
@stop

@section('content')
	@include('backend.modals.delete_confirm')
	<div class="width50_bottom10">
 		<a class="close add_info" href="{{{ URL::to('admin/categories/create') }}}"><img src="{{asset('assets/image/background/add_icon.png')}}" class="image_size300" alt="add"></a>
 	</div> 
    <div class="row">
        <div class="col-md-12">
			<form method="POST" action="{{{ URL::to('admin/categories/detroy') }}}" style="display:inline">
				<div class="panel panel-primary">
			        <div class="panel-heading">
						<a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa danh mục phần mềm" data-message="Bạn chắc chắn muốn xóa các danh mục đã chọn ?"><span class="glyphicon glyphicon-trash"></span></a>
			            <h3 class="panel-title">Danh Mục Phần Mềm</h3>
			        </div>
					<div class="panel-body background_EB">
							<table class="display" id="categories_table">
								<thead>
									<tr>
										<th class="col-xs-1"><div class="icon0"></div></th>
										<th class="col-xs-1">ID</th>
										<th class="col-xs-5">Danh Mục</th>
										<th class="col-xs-3">Số Phần Mềm</th>
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
				    <h3 class="panel-title">Hoạt Động Danh Mục</h3>
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
		</div>
	</div>

@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
           oTable =   $('#categories_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 1, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{{ URL::to('admin/categories/data') }}}",
		        "language": {
		            "url":"{{asset('assets/data-table/language/categories.json')}}",
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
		        "sAjaxSource": "{{{ URL::to('admin/activities/data-category/0') }}}",
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
