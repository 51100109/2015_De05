@extends('backend.admin.index')

@section('title')
	Phần Mềm
@stop

@section('hidden')
 	<div class="show_hidden">
        <div class="col-xs-1 icon_software"></div>
    </div>
    <div class="hiddenlist">
		<div class="panel panel-primary null">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Phần Mềm</h3>
            </div>
            <div class="panel-body background_EB">
                <table class="display" id="softwares_hidden_table">
                    <thead>
                        <tr>    
                            <th class="col-xs-1">ID</th>
                            <th class="col-xs-9">Phần Mềm</th>
                            <th class="col-xs-1"></th>
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
	<div class="width50_bottom10">
 		<a class="close add_info" href="{{asset('admin/softwares/create')}}"><img src="{{asset('assets/image/background/add_icon.png')}}" class="image_size300" alt="add"></a>
 	</div>
	<div class="row">
		<div class="col-xs-12">
			<form method="POST" action="{{asset('admin/softwares/detroy')}}" style="display:inline">
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
			</form>
			
			<div class="panel panel-primary">
				<div class="panel-heading">
				    <h3 class="panel-title">Hoạt Động Phần Mềm</h3>
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
            oTable =   $('#softwares_table').dataTable({
                "scrollY":        length,
                "scrollCollapse": true,
                "order": [[ 4, "desc" ]],
                "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/softwares/data') }}",
		 		"language": {
		            "url":"{{asset('assets/data-table/language/softwares.json')}}",
		            "sLoadingRecords": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		            "sProcessing": '<img src="{{asset('assets/image/background/Loading.gif')}}" alt="loading">',
		        },
		       	"drawCallback": function ( settings ) {
		       		$(".show_info_entry").colorbox({
		                  iframe:true, 
		                      width:"70%", 
		                      height:"90%",
		                      rel:'show_info_entry', 
		                      current: "Entry {current} of {total}",
		                      previous: "Previous",
		                      next: "Next",
		                      close: "Close",
		                      onClosed: updatetable,
		                      fixed:true,
		            });
		            $(".edit_info_entry").colorbox({
		                  iframe:true, 
		                      width:"70%", 
		                      height:"90%",
		                      rel:'edit_info_entry', 
		                      current: "Entry {current} of {total}",
		                      previous: "Previous",
		                      next: "Next",
		                      close: "Close",
		                      onClosed: updatetable,
		                      fixed:true,
		            });
		        },
        	});

           	oTable_hidden =   $('#softwares_hidden_table').dataTable({
                "sDom": "<'row'<'col-xs-12'f>r>t<'row'<'col-xs-12'p>>",
                "bLengthChange": false,
                "bInfo" : false,
                "order": [[ 0, "desc" ]],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/softwares/data-hidden') }}",
                "language": {
		            "url":"{{asset('assets/data-table/language/softwares.json')}}",
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
		        "sAjaxSource": "{{ URL::to('admin/activities/data-software/0') }}",
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