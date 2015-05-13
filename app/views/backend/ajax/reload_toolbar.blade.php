
            <ul class="nav navbar-nav">
              @foreach($system as $item)
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><img src="{{ $item->image }}" class="size20" alt="icon"> {{ $item->name }} <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu">
                  @foreach(explode(PHP_EOL,$item->id_category) as $category)
                      @if(is_numeric($category))
                          <li><a href="{{{ URL::to('admin/softwares/category/'.$item->id.'/'.$category) }}}"><img src="{{ Category::find($category)->image }}" class="size20" alt="icon">  {{ Category::find($category)->name }}</a></li>
                      @endif
                  @endforeach
                  <li class="divider"></li>
                </ul>
              </li>
              @endforeach
            </ul>


<script type="text/javascript">

  $(document).ready(function() {
    $(".dropdown").hover(            
                  function() {
                      $('.dropdown-menu', this).stop( true, true ).fadeIn("low");
                      $(this).toggleClass('open');
                      $('b', this).toggleClass("caret caret-up");                
                  },
                  function() {
                      $('.dropdown-menu', this).stop( true, true ).fadeOut("low");
                      $(this).toggleClass('open');
                      $('b', this).toggleClass("caret caret-up");                
                  });
});

</script>
