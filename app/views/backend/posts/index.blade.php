@extends('backend.admin.index')

@section('title')
	Bài Đăng
@stop

@section('hidden')
	<div class="show_hidden">
        <div class="col-xs-1 icon_post"></div>
    </div>
    <div class="hiddenlist">
			<div class="panel panel-primary null">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Bài Đăng</h3>
                </div>
                <div class="panel-body background_EB">
                    <table class="display" id="posts_table_hidden">
                            <thead>
                                <tr>    
                                    <th class="col-xs-1">ID</th>
                                    <th class="col-xs-10">Tiêu Đề</th>
                                    <th class="col-xs-1"></th>
                                </tr>
                            </thead>
                    </table>
                </div>
			</div>
	</div>
@stop

@section('content')
 	@include('backend.modals.delete_confirm')
     
    <div class="row">
        <div class="col-xs-12">
			<form method="POST" action="{{asset('admin/posts/detroy')}}" style="display:inline">
				<div class="panel panel-primary">
			        <div class="panel-heading">
						<a class="close deleteWhite em1_4" data-toggle="modal" href="#confirmDelete" data-title="Xóa bài đăng" data-message="Bạn chắc chắn muốn xóa các bài đăng đã chọn ?"><span class="glyphicon glyphicon-trash"></span></a>
			            <h3 class="panel-title">Danh Sách Bài Đăng</h3>
			        </div>
					<div class="panel-body background_EB">
						<table id="posts_table" class="display" >
							<thead>
								<tr>    
									<th class="col-xs-1"><div class="icon0"></div></th>
									<th class="col-xs-1">ID</th>
									<th class="col-xs-4">Tiêu Đề</th>
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
				    <h3 class="panel-title">Hoạt Động Bài Đăng</h3>
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
        var oTable;
        var oTable_hidden;
        var oTable_activities;
        var length = window.innerHeight * 0.7;

        function updatetable(){
        	parent.oTable.fnReloadAjax();
            parent.oTable_hidden.fnReloadAjax();
            parent.oTable_activities.fnReloadAjax();
        }

		$(document).ready(function() {
           oTable =   $('#posts_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 1, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/posts/data') }}",
		        "language": {
		            "url":"{{asset('assets/data-table/language/posts.json')}}",
		            "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		            "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		        },
		       	"fnDrawCallback": colorbox_show,
        	}); 

         oTable_hidden =   $('#posts_table_hidden').dataTable({
                "sDom": "<'row'<'col-xs-12'f>r>t<'row'<'col-xs-12'p>>",
                "bLengthChange": false,
                "bInfo" : false,
                "order": [[ 0, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/posts/data-hidden') }}",
                "language": {
		            "url":"{{asset('assets/data-table/language/posts.json')}}",
		            "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		            "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		        },
                "fnDrawCallback": colorbox_show_hidden,
            });              

        oTable_activities =   $('#activities_table').dataTable({
        	 	"scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/activities/data-post/0') }}",
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
