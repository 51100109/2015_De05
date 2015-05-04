@extends('backend.admin.index')

@section('title')
Trang Chủ Admin
@stop

@section('content')
      <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <label>Điều khoản sử dụng</label>
          <ol>
              <li>Admin có thể cập nhật các thông tin về phần mềm.</li>
              <li>Admin có thể quản lý bài đăng, bình luận của người dùng</li>
              <li>Admin có thể quản lý tài khoản của người dùng</li>
          </ol>
           
      </div>
      <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Administrator - Hoạt Động Gần Đây</h3>
                    </div>

                    @if ($admin_activities->count())
                    <div class="panel-body">
                        <table class="table table-hover tablesorter">
                            <thead>
                                <tr>   
                                    <th>Admin</th>
                                    <th>Hoạt Động</th>
                                    <th>ID Đối Tượng</th>
                                    <th>Đối Tượng</th>
                                    <th>Thông Tin</th>
                                    <th>Thời Gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admin_activities as $log)
                                <tr>
                                    <td>
                                        @if(!empty( UserAccount::find($log->id_user)))
                                            <a href="<?php echo asset("admin/user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username }}</a>
                                        @else
                                            [ Không tồn tại ]
                                        @endif
                                    </td>
                                    <td>{{ $log->activity }}</td>
                                    <td>
                                        @if(($log->target == 'Nhà phát hành')&&(!empty(Publisher::find($log->id_target))))
                                            <a href="<?php echo asset("admin/publishers/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Danh mục')&&(!empty(Category::find($log->id_target))))
                                            <a href="<?php echo asset("admin/categories/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Hệ điều hành')&&(!empty(OperateSystem::find($log->id_target))))
                                            <a href="<?php echo asset("admin/operate-systems/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Phần mềm')&&(!empty(Software::find($log->id_target))))
                                            <a href="<?php echo asset("admin/softwares/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Thành viên')&&(!empty(UserAccount::find($log->id_target))))
                                            <a href="<?php echo asset("admin/user-accounts/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Bài đăng')&&(!empty(Post::find($log->id_target))))
                                            <a href="<?php echo asset("admin/posts/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Bình luận')&&(!empty(Comment::find($log->id_target))))
                                            <a href="<?php echo asset("admin/comments/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @else
                                            {{ $log->id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                        @endif
                                    </td>
                                    <td>{{ $log->target }}</td>
                                    <td>{{ $log->infor }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                        <a href="{{asset('admin/activities/index')}}" class="block"> Xem thêm <span class="glyphicon glyphicon-arrow-right"></span></a>
                        </div>
                    </div>
                    @else
                        <div class="panel-body">
                             Chưa có thông tin.
                        </div>
                    @endif
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thành viên - Hoạt Động Gần Đây</h3>
                    </div>

                    @if ($user_activities->count())
                    <div class="panel-body">
                        <table class="table table-hover tablesorter">
                            <thead>
                                <tr>
                                    <th>Thành viên</th>
                                    <th>Hoạt Động</th>
                                    <th>ID Đối Tượng</th>
                                    <th>Đối Tượng</th>
                                    <th>Thông Tin</th>
                                    <th>Thời Gian <i class="fa fa-sort"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_activities as $log)
                                <tr>
                                    <td>
                                        @if(!empty( UserAccount::find($log->id_user)))
                                            <a href="<?php echo asset("admin/user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username }}</a>
                                        @else
                                            [ Không tồn tại ]
                                        @endif
                                    </td>
                                    <td>{{ $log->activity }}</td>
                                    <td>
                                        @if(($log->target == 'Phần mềm')&&(!empty(Software::find($log->id_target))))
                                            <a href="<?php echo asset("admin/softwares/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Bài đăng')&&(!empty(Post::find($log->id_target))))
                                            <a href="<?php echo asset("admin/posts/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @elseif(($log->target == 'Bình luận')&&(!empty(Comment::find($log->id_target))))
                                            <a href="<?php echo asset("admin/comments/information/{$log->id_target}"); ?>" class="block"> {{ $log->id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                        @else
                                            {{ $log->id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                        @endif
                                    </td>
                                    <td>{{ $log->target }}</td>
                                    <td>{{ $log->infor }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                        <a href="{{asset('admin/activities/index')}}" class="block"> Xem thêm <span class="glyphicon glyphicon-arrow-right"></span></a>
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