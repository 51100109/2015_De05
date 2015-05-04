<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
      
    
  </head>

  <body>
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
        <div class="page-header alert alert-info null_top">
                <ul class="pager">
                    <li class="previous"><a onclick="goBack()">Back</a></li>
                    <li class="title slogan">@yield('title_modals')</li>
                    <li class="next"><a onclick="goForward()">Forward</a></li>
                </ul>
        </div>
        <div class="container">
            @yield('modals')
        </div>
        
          <!-- JavaScript -->
        <script type="text/javascript" src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/prettify.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/data-table/js/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/data-table/js/dataTables.bootstrap.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/colorbox/js/jquery.colorbox.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

        <script type='text/javascript' src="{{asset('assets/js/jquery-ui.js')}}"></script>
        <script type='text/javascript' src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
        <script type="text/javascript">
            function goBack() {
                window.history.back();
            }

            function goForward() {
                window.history.forward();
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

            $(document).ready(function(){
                createAutoClosingAlert(".alert-message", 3000);
                
                $(".hidden_box").ready(function(){
                  $(".hidden_box").hover(function(){
                  $(".hidden_box").animate({right:"0"},500);
                  },function(){
                      $(".hidden_box").animate({right:"-300"},400);
                      });
                  return false;
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

            CKEDITOR.config.height = window.innerHeight * 0.8;
            CKEDITOR.config.skin = 'office2013';
            CKEDITOR.config.toolbar = [
               ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
               ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
               ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source'],
               '/',
               ['Styles','Format','Font','FontSize'],
            ] ;
        </script>
        @yield('scripts')
        @yield('scripts_activities')
        @yield('scripts_validator')
  </body>

  </html>

  