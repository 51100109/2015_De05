@extends('categories.main')

@section('title')
  Thông tin danh mục phần mềm
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('categories/index')}}"> Danh mục phần mềm</a></li>
            <li><a href="{{asset('categories/show')}}"> Thông tin danh mục</a></li>
            <li class="active">{{ $show->name }}</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Danh Mục Phần Mềm</h2>
    </div>
    <div class="row"> 
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="{{asset('categories/index')}}">Danh mục phần mềm</a></li>
                <li><a href="{{asset('categories/create')}}">Thêm danh mục</a></li>
                <li><a href="{{asset('categories/edit/0')}}">Chỉnh sửa danh mục</a></li>
                <li><a href="{{asset('categories/delete/0')}}">Xóa danh mục</a></li>
                <li  class="active"><a href="{{asset('categories/show')}}">Thông tin danh mục</a></li>
            </ul>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông Tin Danh Mục Phần Mềm</h3>
                </div>
                <div class="panel-body">
                    @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <label class="success"><span class="glyphicon glyphicon-ok"></span> {{Session::get('success')}}</label>
                                {{ Session::forget("success") }}
                            </div>
                    @endif 
                   <table class="table table-hover tablesorter"> 
                         <tbody>
                                <tr>
                                    <th class="headerwidth">ID</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->id }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Danh mục</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->name }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Phần mềm</th>
                                    <td class="colonwidth">:</td>
                                    <td><!--Add code here --></td>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Hoạt Động Gần Đây</h3>
                </div>

                @if ($activities->count())
                <div class="panel-body">
                    <table class="table table-hover tablesorter">
                        <thead>
                            <tr>   
                                <th>Admin</th>
                                <th>Hoạt Động</th>
                                <th>ID</th>
                                <th>Danh mục</th>
                                <th>Thời Gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $log)
                            <tr>
                                <td>
                                    @if(!empty( UserAccount::find($log->id_user)))
                                        <a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username }}</a>
                                    @else
                                        [ Không tồn tại ]
                                    @endif
                                </td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->id_target }}</td>
                                <td>{{ $log->infor }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        {{$activities->links()}}
                    </div>
                </div>
                @else
                    <div class="panel-body">
                        Chưa có thông tin.
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop