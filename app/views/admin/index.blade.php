<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}" />
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('assets/css/mystyle.css')}}"  media="all" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}"  media="all" rel="stylesheet">

      <!-- JavaScript -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script> 
    <script type="text/javascript" src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/tablesorter/js/jquery.tablesorter.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/tablesorter/js/tables.js')}}"></script>

    <!-- sctip validate-->
    <script type='text/javascript' src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script type='text/javascript' src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>

  </head>

  <body>
  <div class="container" id="banner">

  <div class="row" style="margin:0">
          <div class="col-md-3" style="margin:0px;padding:0px;">
          <img src="{{asset('assets/image/weblogo.png')}}" alt="logoweb" id="logo">
          </div>

          <div class="col-md-9" style="margin:0px;padding:0px;">
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
                      <img src="{{asset('assets/image/banner1.jpg')}}" alt="Slide 1">
                      <div class="carousel-caption">
                         
                      </div>
                    </div>
                    <div class="item">
                      <img src="{{asset('assets/image/banner2.jpg')}}" alt="Slide 2">
                      <div class="carousel-caption">
                          
                      </div>
                    </div>
                    <div class="item">
                      <img src="{{asset('assets/image/banner3.jpg')}}" alt="Slide 3">
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
            <a class="navbar-brand" href="{{asset('admin/home')}}"><span class="glyphicon glyphicon-fire"></span> Administrator</a>
          </div>
          
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav nav-tabs">
              <li class="active"><a href="{{asset('admin/home')}}"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">Window <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Bảo mật</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Diệt virut - Spyware</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Internet & Email</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Ứng dụng văn phòng</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Dữ liệu - File</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Phần mềm doanh nghiệp</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Phần mềm giáo dục </a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Audio & Video</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Công cụ lập trình</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Drivers</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Hỗ trợ Mobile</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Phần mềm khác</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Hệ thống</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">Mac <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Bảo mật</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Diệt virut - Spyware</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Internet & Email</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Ứng dụng văn phòng</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Dữ liệu - File</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Phần mềm doanh nghiệp</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Phần mềm giáo dục </a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Audio & Video</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Công cụ lập trình</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Drivers</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Hỗ trợ Mobile</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Phần mềm khác</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Hệ thống</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">Mobile <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Window Phone</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Android</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> iOS</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-minus"></span> Symbian</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
            </ul>
           <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"> Phần mềm<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{asset('softwares/index')}}"><span class="glyphicon glyphicon-cog"></span> Danh sách phần mềm</a></li>
                  <li><a href="{{asset('categories/index')}}"><span class="glyphicon glyphicon-cog"></span> Danh mục phần mềm</a></li>
                  <li><a href="{{asset('operate-systems/index')}}"><span class="glyphicon glyphicon-cog"></span> Hệ điều hành</a></li>
                  <li><a href="{{asset('publishers/index')}}"><span class="glyphicon glyphicon-cog"></span> Nhà phát hành</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"> Thành viên<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{asset('user-accounts/index')}}"><span class="glyphicon glyphicon-cog"></span> Danh sách thành viên</a></li>
                  <li><a href="{{asset('posts/index')}}"><span class="glyphicon glyphicon-cog"></span> Các bài đăng</a></li>
                  <li><a href="{{asset('comments/index')}}"><span class="glyphicon glyphicon-cog"></span> Các bình luận</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Admin<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Inbox</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Đổi mật khẩu</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Thoát</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      


      <div class="row">
        <div class="col-md-3">
          <ul class="nav nav-pills nav-stacked">
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp0"><span class="glyphicon glyphicon-check"></span> Hoạt động gần đây <span class="caret arrow" id="right"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="pp0">
                <li><a href="{{asset('admin/admin-activities')}}"><span class="glyphicon glyphicon-chevron-right"></span> Administrator</a></li>
                <li><a href="{{asset('admin/user-activities')}}"><span class="glyphicon glyphicon-chevron-right"></span> Thành viên</a></li>
              
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp1"><span class="glyphicon glyphicon-check"></span> Window <span class="caret arrow" id="right"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="pp1">
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Bảo mật</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Diệt virut - Spyware</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Internet & Email</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Ứng dụng văn phòng</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Dữ liệu - File</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Phần mềm doanh nghiệp</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Phần mềm giáo dục </a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Audio & Video</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Công cụ lập trình</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Drivers</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Hỗ trợ Mobile</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Phần mềm khác</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Hệ thống</a></li> 
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp2"><span class="glyphicon glyphicon-check"></span> Mac <span class="caret arrow" id="right"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="pp2">
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Bảo mật</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Diệt virut - Spyware</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Internet & Email</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Ứng dụng văn phòng</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Dữ liệu - File</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Phần mềm doanh nghiệp</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Phần mềm giáo dục </a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Audio & Video</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Công cụ lập trình</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Drivers</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Hỗ trợ Mobile</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Phần mềm khác</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Hệ thống</a></li> 
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp3"><span class="glyphicon glyphicon-check"></span> Mobile <span class="caret arrow" id="right"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="pp3">
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Window Phone</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Android</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> iOS</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Symbian</a></li>
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp4"><span class="glyphicon glyphicon-check"></span> Quản lý phần mềm <span class="caret arrow" id="right"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="pp4">
                <li><a href="{{asset('softwares/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Danh sách phần mềm</a></li>
                <li><a href="{{asset('categories/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Danh mục phần mềm</a></li>
                <li><a href="{{asset('operate-systems/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Hệ điều hành</a></li>
                <li><a href="{{asset('publishers/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Nhà phát hành</a></li>
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp5"><span class="glyphicon glyphicon-check"></span> Quản lý thành viên <span class="caret arrow" id="right"></span></a></div>    
              <ul class="nav nav-pills nav-stacked collapse" id="pp5">
                <li><a href="{{asset('user-accounts/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Danh sách thành viên</a></li>
                <li><a href="{{asset('posts/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Các bài đăng</a></li>
                <li><a href="{{asset('comments/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Các bình luận</a></li>
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp6"><span class="glyphicon glyphicon-check"></span> Quản lý Menu <span class="caret arrow" id="right"></span></a></div>
              <ul class="nav nav-pills nav-stacked collapse" id="pp6">
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> l1</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> l2</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> l3</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> l4</a></li>
              </ul>
              </div>
            </li>
        </ul>
        </div>
        <div class="col-md-9">    
          <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
          </div>
        </div>
      </div>

  </div> 

    <script type="text/javascript">
            $(document).ready(function(){
                $(".hidden_box").hover(function(){
                $(".hidden_box").animate({right:"0"},500);
                },function(){
                    $(".hidden_box").animate({right:"-260"},400);
                    });
            return false;
        });
    </script>
  <div class="hidden_box" style="right: -260px;">
     <div class="show_hidden">
     <div class="panel panel-primary" style="margin:0;padding:0">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span></h3>
            </div>
          </div>
      </div>
      <div class="hiddenlist">
            @yield('hidden')
      </div>
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
          <div class="social-icons">
              <a class="ttip-none" href="#" title="Rss"><i class="fa fa-rss"></i></a>
          </div>
          <div class="alignleft"> © Sharing Free Softwares </div>
          <div class="clear"></div>
      </div>
  </div>
 <!-- <div id="topcontrol" class="fa fa-angle-up" title="Scroll To Top" style="bottom: 10px;"></div>
  <div id="fb-root"></div>-->

  </body>
</html>