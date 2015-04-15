@extends('operate-systems.main')

@section('title')
  Thông tin hệ điều hành
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('operate-systems/index')}}"> Hệ điều hành</a></li>
            <li><a href="{{asset('operate-systems/show')}}"> Thông tin hệ điều hành</a></li>
            <li class="active">{{ $show->name }}</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Hệ Điều Hành</h2>
    </div>
    <div class="row"> 
        <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li><a href="{{asset('operate-systems/index')}}">Hệ điều hành</a></li>
                    <li><a href="{{asset('operate-systems/create')}}">Thêm hệ điều hành</a></li>
                    <li><a href="{{asset('operate-systems/edit/0')}}">Chỉnh sửa hệ điều hành</a></li>
                    <li><a href="{{asset('operate-systems/delete/0')}}">Xóa hệ điều hành</a></li>       
                    <li  class="active"><a href="{{asset('operate-systems/show')}}">Thông tin hệ điều hành</a></li>
                </ul>
                <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông Tin Hệ Điều Hành</h3>
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
                                    <th class="headerwidth">Hệ điều hành</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->name }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Phần mềm</th>
                                    <td class="colonwidth">:</td>
                                    <td> <!--Add code here --></td>
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
                                    <th>Hệ điều hành</th>
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