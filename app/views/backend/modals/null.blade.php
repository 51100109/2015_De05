@extends('backend.modals.layout_colorbox')

@section('title')
    Thông Tin {{ $item }}
@stop

@section('title_modals')
  Thông tin {{ $item }}
@stop

@section('modals')
	<div class="panel panel-primary">
        <div class="panel-heading">
			<h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body">
			Chưa có thông tin
        </div>
    </div>
@stop