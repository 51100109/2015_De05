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
            <a class="navbar-brand" href="{{asset('admin/activities/home')}}"><span class="glyphicon glyphicon-fire"></span> Administrator</a>
          </div>
          
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav nav-tabs">
              <li><a href="{{asset('admin/activities/home')}}"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
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
                  <li><a href="{{asset('admin/softwares/index')}}"><span class="glyphicon glyphicon-cog"></span> Phần mềm</a></li>
                  <li><a href="{{asset('admin/categories/index')}}"><span class="glyphicon glyphicon-cog"></span> Danh mục</a></li>
                  <li><a href="{{asset('admin/operate-systems/index')}}"><span class="glyphicon glyphicon-cog"></span> Hệ điều hành</a></li>
                  <li><a href="{{asset('admin/publishers/index')}}"><span class="glyphicon glyphicon-cog"></span> Nhà phát hành</a></li>
                  <li class="divider"></li>
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"> Thành viên<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{asset('admin/activities/index')}}"><span class="glyphicon glyphicon-cog"></span> Hoạt động</a></li>
                  <li><a href="{{asset('admin/user-accounts/index')}}"><span class="glyphicon glyphicon-cog"></span> Thành viên</a></li>
                  <li><a href="{{asset('admin/posts/index')}}"><span class="glyphicon glyphicon-cog"></span> Bài đăng</a></li>
                  <li><a href="{{asset('admin/comments/index')}}"><span class="glyphicon glyphicon-cog"></span> Bình luận</a></li>
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
        <div class="col-xs-3">
          <ul class="nav nav-pills nav-stacked">
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
                <li><a href="{{asset('admin/softwares/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Phần mềm</a></li>
                <li><a href="{{asset('admin/categories/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Danh mục</a></li>
                <li><a href="{{asset('admin/operate-systems/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Hệ điều hành</a></li>
                <li><a href="{{asset('admin/publishers/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Nhà phát hành</a></li>
              </ul>
              </div>
            </li>
            <li>
              <div class="panel panel-info">
              <div class="panel-heading"><a data-toggle="collapse" data-parent="#stacked-menu" href="#pp5"><span class="glyphicon glyphicon-check"></span> Quản lý thành viên <span class="caret arrow" id="right"></span></a></div>    
              <ul class="nav nav-pills nav-stacked collapse" id="pp5">
                <li><a href="{{asset('admin/activities/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Hoạt động</a></li>
                <li><a href="{{asset('admin/user-accounts/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Thành viên</a></li>
                <li><a href="{{asset('admin/posts/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Bài đăng</a></li>
                <li><a href="{{asset('admin/comments/index')}}"><span class="glyphicon glyphicon-chevron-right"></span> Bình luận</a></li>
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
        <div class="col-xs-9">    
          <div class="row">
            <div class="col-xs-12">
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
  <div class="hidden_box" style="right: -300px;">
        @yield('hidden')
    </div>
    <div class="message" style="right:50px;">
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

    <script type="text/javascript" src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/prettify.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/data-table/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/data-table/js/jquery.dataTables.rowGrouping.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/data-table/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/colorbox/js/jquery.colorbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/colorbox/js/jquery.easing.min.js')}}"></script>

    <script type='text/javascript' src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script type='text/javascript' src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/data-table/js/datatables.fnReloadAjax.js')}}"></script>
    <script type="text/javascript" charset="utf-8">
        function goBack() {
            window.history.back();
        }

        function check_highlight(element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).addClass(errorClass).removeClass(validClass);
            } else {
                $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback');
                $(element).closest('.form-group').find('i.fa').remove();
                $(element).closest('.form-group').append('<i class="fa fa-exclamation fa-lg form-control-feedback"></i>');
            }
        }
        function check_unhighlight(element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).removeClass(errorClass).addClass(validClass);
            } else {
                $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                $(element).closest('.form-group').find('i.fa').remove();
                $(element).closest('.form-group').append('<i class="fa fa-check fa-lg form-control-feedback"></i>');
            }
        }

        function createAutoClosingAlert(selector, delay) {
           var alert = $(selector).alert();
           window.setTimeout(function() { alert.alert('close') }, delay);
        }

        function updatetable(){}

        function colorbox_activity( oSettings ) {
                $(".show_info_activity").colorbox({
                      iframe:true, 
                      width:"70%", 
                      height:"90%",
                      rel:'show_info_activity', 
                      current: "Activity {current} of {total}",
                      previous: "Previous",
                      next: "Next",
                      close: "Close",
                      fixed:true,
                });
                $(".show_info").colorbox({
                      iframe:true, 
                      width:"70%", 
                      height:"90%",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
                });
          }

        function colorbox_show(oSettings){
              $(".show_info_entry").colorbox({
                      iframe:true, 
                      width:"70%", 
                      height:"90%",
                      rel:'show_info_entry', 
                      current: "Entry {current} of {total}",
                      previous: "Previous",
                      next: "Next",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
              /*        opacity : 0,
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

                          $('#cboxOverlay').css(effects_2).animate(effects_1, 1200,
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
                                  duration: 4000,
                                  easing: 'easeOutElastic'
                              });
                          });
                      }    */
              });

              $(".edit_info_entry").colorbox({
                      iframe:true, 
                      width:"70%", 
                      height:"90%",
                      rel:'edit_info_entry', 
                      current: "Entry {current} of {total}",
                      previous: "Previous",
                      next: "Next",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
              });
            }    

        function colorbox_show_hidden( oSettings ) {
              $(".show_info_hidden").colorbox({
                        iframe:true, 
                        width:"70%", 
                        height:"90%",
                        rel:'show_info_hidden', 
                        current: "Entry {current} of {total}",
                        previous: "Previous",
                        next: "Next",
                        close: "Close",
                        onClosed: updatetable,
                        fixed:true,
              });

              $(".edit_info_hidden").colorbox({
                  iframe:true, 
                      width:"70%", 
                      height:"90%",
                      rel:'edit_info_hidden', 
                      current: "Entry {current} of {total}",
                      previous: "Previous",
                      next: "Next",
                      close: "Close",
                      onClosed: updatetable,
                      fixed:true,
              });
        }

        $(document).ready(function() {
              createAutoClosingAlert(".alert-message", 3000);

              $(".hidden_box").ready(function(){
                  $(".hidden_box").hover(function(){
                  $(".hidden_box").animate({right:"0"},500);
                  },function(){
                      $(".hidden_box").animate({right:"-300"},400);
                      });
                  return false;
              });
      
              $(".add_info").colorbox({
                  iframe:true, 
                  width:"70%", 
                  height:"90%",
                  close: "Close",
                  onClosed: updatetable,
                  fixed:true,
              });

              $('#confirmDelete').on('show.bs.modal', function (e) {
                    $message = $(e.relatedTarget).attr('data-message');
                    $(this).find('.modal-body p').text($message);
                    $title = $(e.relatedTarget).attr('data-title');
                    $(this).find('.modal-title').text($title);

                    var form = $(e.relatedTarget).closest('form');
                    $(this).find('.modal-footer #confirm').data('form', form);
                  });

              $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
                      $(this).data('form').submit();
                  });
   
          });
  </script>
      @yield('scripts')
  </body>
</html>