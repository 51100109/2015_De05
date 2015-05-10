@extends('backend.modals.layout_colorbox')

@section('title')
    Xóa {{ $title }} 
@stop

@section('title_modals')
    <div class="title fontsize1_5em"><b>Xóa {{ $title }} </b></div>
@stop

@section('modals')
    @if($counter == 0)
        <form method="POST" action="{{{ URL::to('admin/'.$item.'/delete/'.$id) }}}" class="container deleteForm"> 
            <div class="form-group">
                <b>Bạn chắc chắn muốn xóa {{ $title }} <span class="fontsize1_2em">{{ $content }} (ID:{{ $id }})</span></b>
                <br><br>
                <div class="text-right">
                    <button type="submit" class="btn btn-danger width100">Xác nhận</button>
                    <button type="button" class="btn btn-default close_colorbox width100">Bỏ qua</button>
                </div>
            </div>
        </form>
    @else
        <b>Không thể xóa {{ $title }} <span class="fontsize1_2em">{{ $content }} (ID: {{ $id }})</span> vì tồn tại <span class="fontsize1_2em">{{ $counter }} phần mềm</span> liên quan.</b> 
        <br><br>
        <div class="text-right">
            <button type="button" class="btn btn-default close_colorbox width100">Đóng</button>
        </div>
    @endif
@stop