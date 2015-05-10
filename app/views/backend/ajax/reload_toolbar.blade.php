                <li><a href="{{{ URL::to('admin/home') }}}"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
                @foreach($system as $item)
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><img src="{{ $item->image }}" class="size20" alt="icon"> {{ $item->name }} <span class="caret"></span></a>
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

    <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.js')}}"></script>