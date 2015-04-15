@extends('user-accounts.main')

@section('title')
  Thông tin thành viên
@stop

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{asset('admin/home')}}"> Trang Chủ</a></li>
            <li><a href="{{asset('user-accounts/index')}}"> Thành viên</a></li>
            <li><a href="{{asset('user-accounts/show')}}"> Thông tin thành viên</a></li>
            <li class="active">{{ $show->username }}</li>
        </ol>
        <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon"> Thành Viên</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="{{asset('user-accounts/index')}}">Thành viên</a></li>
                <li><a href="{{asset('user-accounts/create')}}">Thêm thành viên</a></li>     
                <li><a href="{{asset('user-accounts/delete/0')}}">Xóa thành viên</a></li>      
                <li  class="active"><a href="{{asset('user-accounts/show')}}">Thông tin thành viên</a></li>
            </ul>
            <br>
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông Tin Thành Viên</h3>
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
                                    <th class="headerwidth">Tài khoản</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->username }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Admin</th>
                                    <td class="colonwidth">:</td>
                                    <td>
                                        @if($show->admin == 1)
                                             <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                              <span class="glyphicon glyphicon-minus"></span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Tên thành viên</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->fullname }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Tên hiển thị</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->creenname }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Giới tính</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->gender }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Email</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->email }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Ngày sinh</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->birthday }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Địa chỉ</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->address }}</td>
                                </tr>
                                <tr>
                                    <th class="headerwidth">Điện thoại</th>
                                    <td class="colonwidth">:</td>
                                    <td>{{ $show->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Hoạt động của {{ $show->username }}</h3>
                </div>

                @if ($activities->count())
                <div class="panel-body">
                    <table class="table table-hover tablesorter">
                        <thead>
                            <tr>   
                                <th>Hoạt Động</th>
                                <th>Đối Tượng</th>
                                <th>ID</th>
                                <th>Thông tin</th>
                                <th>Thời Gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $log)
                            <tr>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->target }}</td>
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