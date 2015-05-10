
   
    
  
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
    
    <script type="text/javascript">
        function createAutoClosingAlert(selector, delay) {
           var alert = $(selector).alert();
           window.setTimeout(function() { alert.alert('close') }, delay);
        }
         $(document).ready(function() {
              createAutoClosingAlert(".alert-message", 1000);
            });
    </script>
    