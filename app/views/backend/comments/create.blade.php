@extends('backend.modals.layout_colorbox')

@section('title')
    Thêm Bình Luận
@stop

@section('title_modals')
    <div class="title slogan">Thêm bình luận</div>
@stop

@section('modals')
    <form method="POST" action="{{{ URL::to('admin/comments/create/'.$target.'/'.$id_target) }}}" class="container"> 
		 <div class="row">
                <div class="col-xs-12">
			        <div class="form-group">
			            <label class="control-label" for="content">Nội dung</label> 
			            <textarea type="text" name="content" id="content" class="form-control" style="height:200px;"></textarea>
			        </div> 
			        <div class="form-group">
			        	<div class="text-right">
			            	<button type="submit" class="btn btn-primary width100">Xác nhận</button>
			            	<button type="reset" class="btn btn-warning width100">Tạo lại</button>
			            	<button type="button" class="btn btn-default close_colorbox width100">Đóng</button>
			            </div>
			        </div>
			    </div>
		</div>
    </form>
@stop