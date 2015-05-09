@extends('backend.modals.layout_colorbox')

@section('title')
    Xóa {{ $title }} 
@stop

@section('title_modals')
    <div class="title fontsize1_5em"><b>Xóa {{ $title }} </b></div>
@stop

@section('modals')
    <form method="POST" action="{{{ URL::to('admin/'.$item.'/delete/'.$id) }}}" class="container deleteForm"> 
        <div class="form-group">
            <b>Bạn chắc chắn muốn xóa {{ $title }} <span class="fontsize1_2em">{{ $id }}</span> : <span class="fontsize1_2em">{{ $content }}</span></b>
            <br><br>
            <div class="text-right">
                <button type="submit" class="btn btn-danger width100">Xác nhận</button>
                <button type="button" class="btn btn-default close_colorbox width100">Bỏ qua</button>
            </div>
        </div>
    </form>
@stop