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