@extends('admin.index')
@section('title')
Hoạt Động Thành Viên
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{asset('admin/home')}}"><i class="icon-dashboard"></i> Trang Chủ</a></li>
        <li class="active"><i class="icon-file-alt"></i>Hoạt Động Gần Đây</li>
    </ol>
    <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon">Thành viên</h2>
    <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <h3 class="panel-title">Tất Cả Hoạt Động</h3>
                  </div>

                   @if ($user_activities->count())
                  <div class="panel-body">
                      <table class="table table-hover tablesorter">
                          <thead>
                              <tr>
                                  <th>Thành viên</th>
                                  <th>Hoạt Động</th>
                                  <th>Đối Tượng</th>
                                  <th>ID Đối Tượng</th>
                                  <th>Thông Tin </th>
                                  <th>Thời Gian</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($user_activities as $log)
                              <tr>
                                  <td>
                                      @if(!empty( UserAccount::find($log->id_user)))
                                        <a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username }}</a>
                                      @else
                                        [ Không tồn tại ]
                                      @endif
                                  </td>
                                  <td>{{ $log->activity }}</td>
                                  <td>{{ $log->target }}</td>
                                  <td>
                                        @if(($log->target == 'Nhà phát hành')&&(!empty(Publisher::find($log->id_target))))
                                            <a href="<?php echo asset("publishers/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Danh mục')&&(!empty(Category::find($log->id_target))))
                                            <a href="<?php echo asset("categories/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Hệ điều hành')&&(!empty(OperateSystem::find($log->id_target))))
                                            <a href="<?php echo asset("operate-systems/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Phần mềm')&&(!empty(Software::find($log->id_target))))
                                            <a href="<?php echo asset("softwares/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Thành viên')&&(!empty(UserAccount::find($log->id_target))))
                                            <a href="<?php echo asset("user-accounts/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Bài đăng')&&(!empty(Post::find($log->id_target))))
                                            <a href="<?php echo asset("posts/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Bình luận')&&(!empty(Comment::find($log->id_target))))
                                            <a href="<?php echo asset("comments/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @else
                                            {{ $log->id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                        @endif
                                  </td>
                                  <td>{{ $log->infor }}</td>
                                  <td> {{$log->created_at}}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      <div class="text-right">
                          {{$user_activities->links()}}
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
