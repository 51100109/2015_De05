@extends('front.layouts.mainlayout')

@section('title')
Profile - Softsharing
@endsection

<?php 
	$user = Auth::user();
?>

@section('content')
	<h2>Thông tin tài khoản</h2>            
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Tên tài khoản</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->username }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Tên thành viên</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->fullname }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Tên hiển thị</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->creenname }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Giới tính</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->gender }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Email</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->email }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Ngày sinh</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->birthday }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Địa chỉ</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->address }}</div>
                    </div>
                    <div class="row rowbody">
                        <div class="col-xs-3 color0">Điện thoại</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-8">{{ $user->phone }}</div>
                    </div>                    
@endsection