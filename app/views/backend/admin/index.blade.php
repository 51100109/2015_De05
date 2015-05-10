<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}"  media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/prettify.css')}}" media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/data-table/css/dataTables.bootstrap.css')}}" media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/data-table/css/jquery-ui.css')}}" media="all" rel="stylesheet">    
    <link rel="stylesheet" type="text/css" href="{{asset('assets/data-table/css/dataTables.jqueryui.css')}}" media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/colorbox/css/colorbox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/mystyle.css')}}"  media="all" rel="stylesheet">
   <!-- JavaScript -->

  </head>

  <body>
  <div class="container" id="banner">

  <div class="row" style="margin:0">
          <div class="col-xs-3 null">
              <img src="{{asset('assets/image/background/weblogo.png')}}" alt="weblogo" class="image_size300">
          </div>

          <div class="col-xs-9  null">
                <div id="carousel" class="carousel slide" data-ride="carousel" >
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                  </ol>
                 
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="{{asset('assets/image/background/banner1.jpg')}}" alt="Slide 1">
                      <div class="carousel-caption">
                         
                      </div>
                    </div>
                    <div class="item">
                      <img src="{{asset('assets/image/background/banner2.jpg')}}" alt="Slide 2">
                      <div class="carousel-caption">
                          
                      </div>
                    </div>
                    <div class="item">
                      <img src="{{asset('assets/image/background/banner3.jpg')}}" alt="Slide 3">
                      <div class="carousel-caption">
                          
                      </div>
                    </div>
                  </div>
                 
                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                  </a>
                  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
                </div> <!-- Carousel -->


          </div>
    </div>  

  </div>

   <div class="container" id="shadow"> 
       <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{{ URL::to('admin/home') }}}"><span class="glyphicon glyphicon-fire"></span> Administrator</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          @if(Auth::check())
            <ul class="nav navbar-nav nav-tabs" id="reload_toolbar">
              <li><a href="{{{ URL::to('admin/home') }}}"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
              @foreach($system as $item)
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><img src="{{ $item->image }}" class="size20" alt="icon"> {{ $item->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  @foreach(explode("\n",$item->id_category) as $category)
                      @if(!empty(Category::find($category)))
                          <li><a href="{{{ URL::to('admin/softwares/category/'.$item->id.'/'.$category) }}}"><img src="{{ Category::find($category)->image }}" class="size20" alt="icon">  {{ Category::find($category)->name }}</a></li>
                      @endif
                  @endforeach
                  <li class="divider"></li>
                </ul>
              </li>
              @endforeach
            </ul>
           <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"> Phần mềm<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{{ URL::to('admin/softwares/index') }}}"><span class="glyphicon glyphicon-cog"></span> Phần mềm</a></li>
                  <li><a href="{{{ URL::to('admin/categories/index') }}}"><span class="glyphicon glyphicon-cog"></span> Danh mục</a></li>
                  <li><a href="{{{ URL::to('admin/operate-systems/index') }}}"><span class="glyphicon glyphicon-cog"></span> Hệ điều hành</a></li>
                  <li><a href="{{{ URL::to('admin/publishers/index') }}}"><span class="glyphicon glyphicon-cog"></span> Nhà phát hành</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"> Thành viên<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{{ URL::to('admin/activities/index') }}}"><span class="glyphicon glyphicon-cog"></span> Hoạt động</a></li>
                  <li><a href="{{{ URL::to('admin/user-accounts/index') }}}"><span class="glyphicon glyphicon-cog"></span> Thành viên</a></li>
                  <li><a href="{{{ URL::to('admin/posts/index') }}}"><span class="glyphicon glyphicon-cog"></span> Bài đăng</a></li>
                  <li><a href="{{{ URL::to('admin/comments/index') }}}"><span class="glyphicon glyphicon-cog"></span> Bình luận</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
             
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->username }}<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{{ URL::to('/') }}}"><span class="glyphicon glyphicon-map-marker"></span> Public Page</a></li>
                  <li><a href="{{{ URL::to('admin/user-accounts/edit-admin/'.Auth::user()->id) }}}" class="add_info"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                  <li><a href="{{{ URL::to('logout') }}}"><span class="glyphicon glyphicon-log-out"></span> Thoát</a></li>
                </ul>
              </li>
            </ul>
            @else
             <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ URL::to('register') }}"><span>Đăng ký</span></a></li>
                <li><a href="{{ URL::to('login') }}"><span>Đăng nhập</span></a></li>
              </ul>
            @endif
          </div>
        </div>
      </nav>

    @if(Auth::check())
    <div class="row">
        <div class="col-xs-3" id="reload_toolpanel">
          <ul class="nav nav-pills nav-stacked">
            @foreach($system as $item)
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#{{ $item->id }}" class="block"><img src="{{ $item->image }}" class="size20" alt="icon"> {{ $item->name }} <span class="caret arrow right_top8"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="{{ $item->id }}">
                @foreach(explode("\n",$item->id_category) as $category)
                    @if(!empty(Category::find($category)))
                        <li><a href="{{{ URL::to('admin/softwares/category/'.$item->id.'/'.$category) }}}"><img src="{{ Category::find($category)->image }}" class="size20" alt="icon"> {{ Category::find($category)->name }} <span class="badge right">{{ Software::count($item->id,$category) }}</span></a></li>
                    @endif
                @endforeach 
              </ul>
              </div>
            </li>
            @endforeach
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp4" class="block"><img src="{{asset('assets/image/softwares/software1.png')}}" class="size20" alt="icon"> Quản lý phần mềm <span class="caret arrow right_top8"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="pp4">
                <li><a href="{{{ URL::to('admin/softwares/index') }}}"><img src="{{asset('assets/image/softwares/software_hidden.png')}}" class="size20" alt="icon"> Phần mềm <span class="badge right">{{ Software::all()->count() }}</span></a></li>
                <li><a href="{{{ URL::to('admin/categories/index') }}}"><img src="{{asset('assets/image/categories/category_hidden.png')}}" class="size20" alt="icon"> Danh mục <span class="badge right">{{ Category::all()->count() }}</span></a></li>
                <li><a href="{{{ URL::to('admin/operate-systems/index') }}}"><img src="{{asset('assets/image/systems/system_hidden.png')}}" class="size20" alt="icon"> Hệ điều hành <span class="badge right">{{ OperateSystem::all()->count() }}</span></a></li>
                <li><a href="{{{ URL::to('admin/publishers/index') }}}"><img src="{{asset('assets/image/publishers/publisher_hidden.png')}}" class="size20" alt="icon"> Nhà phát hành <span class="badge right">{{ Publisher::all()->count() }}</span></a></li>
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp5" class="block"><img src="{{asset('assets/image/softwares/software2.png')}}" class="size20" alt="icon"> Quản lý thành viên <span class="caret arrow right_top8"></span></a></div>    
              <ul class="nav nav-pills nav-stacked collapse" id="pp5">
                <li><a href="{{{ URL::to('admin/activities/index') }}}"><img src="{{asset('assets/image/activities/icon.png')}}" class="size20" alt="icon"> Hoạt động <span class="badge right">{{ UserActivity::all()->count() }}</span></a></li>
                <li><a href="{{{ URL::to('admin/user-accounts/index') }}}"><img src="{{asset('assets/image/users/users.png')}}" class="size20" alt="icon"> Thành viên <span class="badge right">{{ UserAccount::all()->count() }}</span></a></li>
                <li><a href="{{{ URL::to('admin/posts/index') }}}"><img src="{{asset('assets/image/posts/posts.png')}}" class="size20" alt="icon"> Bài đăng <span class="badge right">{{ Post::all()->count() }}</span></a></li>
                <li><a href="{{{ URL::to('admin/comments/index') }}}"><img src="{{asset('assets/image/comments/comments.png')}}" class="size20" alt="icon"> Bình luận <span class="badge right">{{ Comment::all()->count() }}</span></a></li>
              </ul>
              </div>
            </li>
        </ul>
        </div>
        <div class="col-xs-9">    
          <div class="row">
            <div class="col-xs-12">
                <div class="row background_F5 alert alert-danger">
                    @yield('breadcrumbs')
                </div>
                <div class="row background_F5 alert alert-success">
                    <ul class="pager null">
                        <li class="previous"><a class="margin10" onclick="goBack()">Back</a></li>
                        <li class="title slogan">@yield('title')</li>
                        <li class="next"><a class="margin10" onclick="goForward()">Forward</a></li>
                    </ul>
                </div> 
                @yield('content')
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="heigh800">
          <center><h2>Vui lòng đăng nhập</h2></center>
      </div>
    @endif
  </div> 

  <footer id="theme-footer">
      <div id="footer-widget-area" class="footer-3c"> </div>
      <div class="clear"></div>
  </footer>
  <div class="clear"></div>
  <div class="footer-bottom">
      <div class="container">
          <div class="alignright">
              Powered by Laravel | Designed by MyGroup
          </div>
          <div class="alignleft"> © Sharing Free Softwares </div>
          <div class="clear"></div>
      </div>
  </div>
 <!-- <div id="topcontrol" class="fa fa-angle-up" title="Scroll To Top" style="bottom: 10px;"></div>
  <div id="fb-root"></div>-->
  <div id="notify_mes">
    <div class="message" style="right:0px;">
        @if(Session::has('success'))
          <div class="alert alert-success alert-dismissable alert-message">
              <label class="success"><span class="glyphicon glyphicon-ok"></span> {{Session::get('success')}}</label>
              {{ Session::forget("success") }}
          </div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger alert-dismissable alert-message">
                <label class="success"><span class="glyphicon glyphicon-exclamation-sign"></span> {{Session::get('fail')}}</label>
                {{ Session::forget("fail") }}
            </div>
        @endif
    </div>
</div>
    <script type="text/javascript" src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/prettify.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/data-table/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/data-table/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/colorbox/js/jquery.colorbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/colorbox/js/jquery.easing.min.js')}}"></script>

    <script type='text/javascript' src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script type='text/javascript' src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/data-table/js/datatables.fnReloadAjax.js')}}"></script>
    <script type="text/javascript" charset="utf-8">
        var oTable;
        var oTable2;
        var oTable_activities;
        var oTable_activities_admin;
        var oTable_activities_member;
        var length = window.innerHeight * 0.7;

        function goBack() {
            window.history.back();
        }

        function goForward() {
            window.history.forward();
        }

        function createAutoClosingAlert(selector, delay) {
           var alert = $(selector).alert();
           window.setTimeout(function() { alert.alert('close') }, delay);
        }

        function toolpanel(result){
            $("#reload_toolpanel").html(result);
        }

        function toolbar(result){
            $("#reload_toolbar").html(result);
        }

        function notify_mes(result){
            $("#notify_mes").html(result);
        }

        function updatetable(){
            parent.oTable.fnReloadAjax();
            parent.oTable_activities.fnReloadAjax();
            $.ajax({
                  url:  "{{{ URL::to('admin/reload-toolpanel') }}}",
                  type:"POST",
                  success: toolpanel,
            });
            $.ajax({
                  url:  "{{{ URL::to('admin/reload-toolbar') }}}",
                  type:"POST",
                  success: toolbar,
            });
             $.ajax({
                  url:  "{{{ URL::to('admin/message') }}}",
                  type:"POST",
                  success: notify_mes,
            });
        }

        function background() {
            $('#cboxOverlay').css({ 'opacity': 0.6,'background': 'white'});
        }

        function colorbox_activity( oSettings ) {
                $(".show_info_activity").colorbox({
                      iframe:true, 
                      width:"80%", 
                      height:"100%",
                      rel:'show_info_activity', 
                      current: "Activity {current} of {total}",
                      previous: "Previous",
                      next: "Next",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
                      onOpen: background,
                });
                $(".show_info").colorbox({
                      iframe:true, 
                      width:"80%", 
                      height:"100%",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
                      onOpen: background,
                });
          }

        function colorbox_show(oSettings){
              $(".show_info_entry").colorbox({
                      iframe:true, 
                      width:"80%", 
                      height:"100%",
                      rel:'show_info_entry', 
                      current: "Entry {current} of {total}",
                      previous: "Previous",
                      next: "Next",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
                      onOpen: background,
              });

              $(".edit_info_entry").colorbox({
                      iframe:true, 
                      width:"80%", 
                      height:"100%",
                      rel:'edit_info_entry', 
                      current: "Entry {current} of {total}",
                      previous: "Previous",
                      next: "Next",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
                      onOpen: background,
              });

              $(".delete_info_entry").colorbox({
                      iframe:true, 
                      width:700, 
                      height:300,
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
                      opacity : 0,
                      onOpen: function() {
                          var effects_1 = {
                                              height: $(document).height(),
                                              width: $(document).width(),
                                              opacity: 0.5,
                                          };
                          var effects_2 = {
                                              'visibility': 'visible',
                                              'width': 0,
                                              'height': 0,
                                              'opacity': 0,
                                              'cursor': 'pointer',
                                              'background': 'black'
                                          };

                          $('#cboxOverlay,#colorbox').css('visibility', 'hidden');

                          $('#cboxOverlay').css(effects_2).animate(effects_1, 500,
                          function() {
                              var $cB = $('#colorbox');
                              var cbW = $cB.height();
                              var cbT = $cB.position().top;
                              $('#colorbox').css({
                                  visibility: 'visible',
                                  height: 0,
                                  opacity: 0,
                                  top: (cbT - 50) + 'px'
                              }).animate({
                                  height: cbW + 'px',
                                  opacity: 1,
                                  top: cbT + 'px'
                              },
                              {
                                  duration: 1000,
                                  easing: 'easeOutElastic'
                              });
                          });
                      }    
              });
            }    

        $(document).ready(function() {
              createAutoClosingAlert(".alert-message", 1000);
      
              $(".add_info").colorbox({
                  iframe:true, 
                  width:"80%", 
                  height:"100%",
                  close: "Close",
                  onClosed: updatetable,
                  fixed:true,
                  onOpen: background,
              });

              $('.close_colorbox').click(function(){
                    parent.jQuery.colorbox.close();
                });
              $('.deleteForm').submit(function(event) {
                    parent.jQuery.colorbox.close();
                });
          });
  </script>
      @yield('scripts')
  </body>
</html>