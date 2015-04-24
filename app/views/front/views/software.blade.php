@extends('front.layouts.mainlayout')

@section('title')
{{{$software->name}}} - Softsharing
@endsection

<?php 
	$category = Category::find($software->id_category);
	$categoryname = $category->name;
	$os = OperateSystem::find($software->id_system);
	$osname = $os->name;
	$publisher = Publisher::find($software->id_publisher);
	$publishername = $publisher->name;
?>

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
		<h1> {{{$software->name}}} </h1>
		<div class="row" style="margin-top: 20px">
			<div class="row">
				<div class="col-xs-12 col-sm-6" style="padding-left: 100px">
					<div class="row">
						<table id="softinfoTable">
							<tr>
								<td width="50%">Sử dụng:</td>
								<td width="50%">{{{$software->license}}}</td>
							</tr>
							<tr>
								<td>Ngôn ngữ:</td>
								<td>{{{$software->language}}}</td>
							</tr>
							<tr>
								<td>Kích thước file:</td>
								<td>{{{$software->filesize}}} KB</td>
							</tr>
							<tr>
								<td>Phân loại:</td>
								<td>{{{$categoryname}}}</td>
							</tr>
							<tr>
								<td>Hệ điều hành:</td>
								<td>{{{$osname}}}</td>
							</tr>
							<tr>
								<td>Nhà phát hành:</td>
								<td>{{{$publishername}}}</td>
							</tr>
						</table>
					</div>
					<div class="row">
						@if(Auth::check())
							<a class="btn btn-success" target="_blank" style="margin-top: 20px" href={{ $software->download }}> Tải xuống  </a> 
						@else
							<div class="well" style="margin-top: 20px">
								<a href="{{asset('login')}}">Đăng nhập </a>để tải về!
							</div>
						@endif
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<img src="{{ URL::to($software->image) }}" height="250px"> 	
				</div>
			</div>
		</div>
		<div class="row">
			<h2>Giới thiệu</h2>
			<p>  {{{$software->description}}} </p>
		</div>
		@include('front.includes.comment',['isSoftware'=>1 ,'software'=>$software])
@endsection