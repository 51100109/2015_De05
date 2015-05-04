<?php
define('ITEMS_HOME', 5);

class UserActivitiesController extends BaseController {

    /**
     * Display a listing of useractivities
     *
     * @return Response
     */
    public function __construct(){
        $this->beforeFilter('check-admin');
    }

    public function getHome(){
        $admin_activities = UserActivity::selected(1,ITEMS_HOME);
        $user_activities = UserActivity::selected(0,ITEMS_HOME);
        return View::make('backend.admin.home')->with('admin_activities', $admin_activities)->with('user_activities', $user_activities);
    }

    public function getIndex(){
        return View::make('backend.user-activities.index');
    }

    public function getInformation($id){
        $show = UserActivity::findOrFail($id);
        return View::make('backend.user-activities.show', compact('show'));
    }

    public function getData($admin){
        $user = UserAccount::where('admin','=',$admin)->get();
        $array=array();
        foreach ($user as $key) {
           array_push($array, $key->id);
        }
        if($admin == 1){
            $activities = UserActivity::whereIn('id_user',$array)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.target as target','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::whereIn('id_user',$array)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.target as target','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
    
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column(
                                'id_target', 
                                '  
                                    @if(($target == "Nhà phát hành")&&(!empty(Publisher::find($id_target))))
                                        <a href="{{{ URL::to(\'admin/publishers/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @elseif(($target == "Danh mục")&&(!empty(Category::find($id_target))))
                                        <a href="{{{ URL::to(\'admin/categories/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @elseif(($target == "Hệ điều hành")&&(!empty(OperateSystem::find($id_target))))
                                        <a href="{{{ URL::to(\'admin/operate-systems/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @elseif(($target == "Phần mềm")&&(!empty(Software::find($id_target))))
                                        <a href="{{{ URL::to(\'admin/softwares/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @elseif(($target == "Thành viên")&&(!empty(UserAccount::find($id_target))))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @elseif(($target == "Bài đăng")&&(!empty(Post::find($id_target))))
                                        <a href="{{{ URL::to(\'admin/posts/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @elseif(($target == "Bình luận")&&(!empty(Comment::find($id_target))))
                                        <a href="{{{ URL::to(\'admin/comments/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 15, \'...\') }}}')
                          ->edit_column('target', '{{{ Str::limit($target, 15, \'...\') }}}')                          ->edit_column('infor', '{{{ Str::limit($infor, 15, \'...\') }}}')
                          ->edit_column('created_at', '{{{ Str::limit($created_at, 10, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }

    public function getDataCategory($id){
        if($id == 0){
            $activities = UserActivity::where('target','=','Danh mục')->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::where('target','=','Danh mục')->where('id_target','=',$id)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 15, \'...\') }}}')
                          ->edit_column(
                                'id_target', 
                                '   @if(!empty(Category::find($id_target)))
                                        <a href="{{{ URL::to(\'admin/categories/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('infor', '{{{ Str::limit($infor, 20, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }

    public function getDataPublisher($id){
        if($id == 0){
            $activities = UserActivity::where('target','=','Nhà phát hành')->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::where('target','=','Nhà phát hành')->where('id_target','=',$id)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 15, \'...\') }}}')
                          ->edit_column(
                                'id_target', 
                                '   @if(!empty(Publisher::find($id_target)))
                                        <a href="{{{ URL::to(\'admin/publishers/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('infor', '{{{ Str::limit($infor, 20, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }

    public function getDataSystem($id){
        if($id == 0){
            $activities = UserActivity::where('target','=','Hệ điều hành')->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::where('target','=','Hệ điều hành')->where('id_target','=',$id)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 15, \'...\') }}}')
                          ->edit_column(
                                'id_target', 
                                '   @if(!empty(OperateSystem::find($id_target)))
                                        <a href="{{{ URL::to(\'admin/operate-systems/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('infor', '{{{ Str::limit($infor, 20, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }

    public function getDataComment($id){
        if($id == 0){
            $activities = UserActivity::where('target','=','Bình luận')->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::where('target','=','Bình luận')->where('id_target','=',$id)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 15, \'...\') }}}')
                          ->edit_column(
                                'id_target', 
                                '   @if(!empty(Comment::find($id_target)))
                                        <a href="{{{ URL::to(\'admin/comments/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('infor', '{{{ Str::limit($infor, 20, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }

    public function getDataPost($id){
        if($id == 0){
            $activities = UserActivity::where('target','=','Bài đăng')->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::where('target','=','Bài đăng')->where('id_target','=',$id)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 15, \'...\') }}}')
                          ->edit_column(
                                'id_target', 
                                '   @if(!empty(Post::find($id_target)))
                                        <a href="{{{ URL::to(\'admin/posts/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('infor', '{{{ Str::limit($infor, 20, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }

    public function getDataSoftware($id){
        if($id == 0){
            $activities = UserActivity::where('target','=','Phần mềm')->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::where('target','=','Phần mềm')->where('id_target','=',$id)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 15, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 15, \'...\') }}}')
                          ->edit_column(
                                'id_target', 
                                '   @if(!empty(Software::find($id_target)))
                                        <a href="{{{ URL::to(\'admin/softwares/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('infor', '{{{ Str::limit($infor, 20, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }

    public function getDataUser($id){
        if($id == 0){
            $activities = UserActivity::where('target','=','Thành viên')->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        else{
            $activities = UserActivity::where('target','=','Thành viên')->where('id_user','=',$id)->leftjoin('user_accounts', 'user_accounts.id', '=','user_activities.id_user')
            ->select(array('user_activities.id as id', 'user_accounts.id as id_user','user_accounts.username as username','user_activities.activity as activity','user_activities.id_target as id_target','user_activities.infor as infor','user_activities.created_at as created_at'));
        }
        
        return  Datatables::of($activities)                   
                          ->add_column(
                                'infor_activity', 
                                '<a href="{{{ URL::to(\'admin/activities/information/\' . $id) }}}" class="show_info_activity close" style="float:left">
                                        @if($activity == "Thêm")
                                            <img src="{{asset(\'assets/image/activities/activity_add.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Xóa")
                                            <img src="{{asset(\'assets/image/activities/activity_delete.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Chỉnh sửa")
                                            <img src="{{asset(\'assets/image/activities/activity_edit.png\')}}" class="size40" alt="{{ $id }}">
                                        @elseif($activity == "Tải về")
                                            <img src="{{asset(\'assets/image/activities/activity_download.png\')}}" class="size40" alt="{{ $id }}">
                                        @else
                                            <img src="{{asset(\'assets/image/activities/activity_view.png\')}}" class="size40" alt="{{ $id }}">
                                        @endif
                                </a>',0)                          
                          ->edit_column(
                                'username', 
                                '   @if(!empty($id_user))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_user) }}}" class="block show_info"> {{{ Str::limit($username, 20, \'...\') }}}</a>
                                    @else
                                        [ ... ]
                                    @endif 
                                ')
                          ->edit_column('activity', '{{{ Str::limit($activity, 20, \'...\') }}}')
                          ->edit_column(
                                'id_target', 
                                '   @if(!empty(UserAccount::find($id_target)))
                                        <a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id_target) }}}" class="block show_info"> {{ $id_target }} <span class="glyphicon glyphicon-link"></span></a>
                                    @else
                                        {{ $id_target }} <span class="glyphicon glyphicon-remove-circle"></span>
                                    @endif
                                ')
                          ->edit_column('infor', '{{{ Str::limit($infor, 20, \'...\') }}}')
                          ->remove_column('id')
                          ->remove_column('id_user')
                          ->make();
    }
}
