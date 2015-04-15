@extends('admin.index')
@section('title')
Hoạt Động Admin
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{asset('admin/home')}}"><i class="icon-dashboard"></i> Trang Chủ</a></li>
        <li class="active"><i class="icon-file-alt"></i>Hoạt Động Gần Đây</li>
    </ol>
    <h2><img src="{{asset('assets/image/icon.png')}}" alt="icon">Administrator</h2>
    <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <h3 class="panel-title">Tất Cả Hoạt Động</h3>
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
                                  <th>Thông Tin </th>
                                  <th>Thời Gian</th>
                              </tr>
                          </thead>
                          <tbody> 
                            <div class="content">                 
                           @foreach($admin_activities as $log)
                                <tr>
                                    <td>
                                        @if(!empty( UserAccount::find($log->id_user)))
                                          <a href="<?php echo asset("user-accounts/information/{$log->id_user}"); ?>" class="block"> {{ UserAccount::find($log->id_user)->username }}</a>
                                        @else
                                          [ Không tồn tại ]
                                        @endif
                                    </td>
                                    <td>{{ $log->activity }}</td>
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
                                    <td>{{ $log->target }}</td>
                                    <td>{{ $log->infor }}</td>
                                    <td>{{$log->created_at}}</td>
                                </tr>
                            @endforeach
                               <div class="text-right">
                          {{$admin_activities->links()}}
                      </div>
                      </div>
                          </tbody>
                      </table>
                     
                  </div>
                  @else
                      <div class="panel-body">
                          Chưa có thông tin.
                      </div>
                  @endif
              </div>
          </div>
      </div>

<script type="text/javascript">

 /*  $(window).on('hashchange',function(){
      page = window.location.hash.replace('#','');
      getActivities(page);
    });
      $(document).on('click','.pagination a',function(e){
          e.preventDefault();
          var page = $(this).attr('href').split('page=')[1];
       //   getAdminActivities(page);
       location.hash = page;
      });

      function getActivities(page){
          $.ajax({
              url:'/ajax/activities?page='+page
          }).done(function(data){
              $('.content').html(data);
           //   location.hash = page;
          });
      }
     */

/*        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getActivities(page);
            }
        }
    });

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getActivities($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });

    function getActivities(page) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function(data) {
            $('.content').html(data);
            location.hash = page;
        }).fail(function() {
            alert('Posts could not be loaded.');
        });
    }

    */
      </script>
@stop
