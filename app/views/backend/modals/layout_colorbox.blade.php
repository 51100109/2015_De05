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
        <div class="page-header alert alert-info null_top">
                <ul class="pager">
                    @yield('title_modals')
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
        <script type="text/javascript" src="{{asset('assets/colorbox/js/jquery.easing.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

        <script type='text/javascript' src="{{asset('assets/js/jquery-ui.js')}}"></script>
        <script type='text/javascript' src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/data-table/js/datatables.fnReloadAjax.js')}}"></script>

        <script type="text/javascript">
            var oTable;
            var oTable_activities;
            var length = window.innerHeight * 0.7;

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

            function selecled_system(){
                var selecled_system = document.getElementById('id_system').value; 
                var origin = document.location.origin;
                $.ajax({
                    url:  origin+"/2015_De05/public/admin/category/"+selecled_system,
                    type:"POST",
                    success: function (result){
                            $("#select_category").html(result);
                    },
                });
            }

            function createAutoClosingAlert(selector, delay) {
               var alert = $(selector).alert();
               window.setTimeout(function() { alert.alert('close') }, delay);
            }

            function notify_mes(result){
                $("#notify_mes").html(result);
            }

            function updatetable(){
                oTable.fnReloadAjax();
                oTable_activities.fnReloadAjax();
                $.ajax({
                  url:  "{{{ URL::to('admin/message') }}}",
                  type:"POST",
                  success: notify_mes,
                });
            }

            function background() {
                $('#cboxOverlay').css({ 'opacity': 0.6,'background': 'white'});
            }

            function openDelete() {
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

            function colorbox_show(oSettings){
              $(".edit_info_entry").colorbox({
                      iframe:true, 
                      width:"60%", 
                      height:"80%",
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
                      onOpen:   openDelete,
              });
            }    

            $(document).ready(function(){
                createAutoClosingAlert(".alert-message", 1000);

                $(".add_info").colorbox({
                    iframe:true, 
                    width:"60%", 
                    height:"80%",
                    close: "Close",
                    onClosed: updatetable,
                    fixed:true,
                    onOpen: background,
                });

                $(".delete_info_entry_close").colorbox({
                      iframe:true, 
                      width:700, 
                      height:300,
                      close: "Close",
                      onClosed: function(){
                          parent.jQuery.colorbox.close();
                      },
                      fixed:true,
                      opacity : 0,
                      onOpen:   openDelete,
                });

                $('.close_colorbox').click(function(){
                    parent.jQuery.colorbox.close();
                });
                $('.deleteForm').submit(function(event) {
                    parent.jQuery.colorbox.close();
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

  