<?php

class UserAccountsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function postCheckUsername(){
		if(UserAccount::where('username','=', Input::get('username'))->count() > 0)
			return "false";
		else
			return "true";
	}
	
	public function postCheckEmail(){
        if(UserAccount::where('email','=', Input::get('email'))->count() > 0)
			return "false";
		else
			return "true";
    }

	public function getIndex(){
		return View::make('backend.user-accounts.index');
	}

	public function getCreate(){
		return View::make('backend.user-accounts.create');
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), UserAccount::$rules_create);
		if ($validator->fails()){
			Session::put('success',"Khởi tạo không thành công");
			return Redirect::back();
		}
		else{
			$user = UserAccount::create($data);
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Thành viên', $user->id,"Tài khoản: " .$user->username. " --- \n Tên: " .$user->fullname. " --- \n Tên hiển thị: " .$user->creenname);
			Session::put('success',"Đã thêm thành viên ".$user->username." có ID: ".$user->id);
			return Redirect::back();
		}
	}

	public function getEdit($id){
		$user = UserAccount::find($id);
		return View::make('backend.user-accounts.edit',compact('user'));
	
	}

	public function postEdit($id){
		$validator = Validator::make($data = Input::all(), UserAccount::$rules_edit);
		if ($validator->fails()){
			Session::put('fail',"Cập nhật không thành công");
			return Redirect::back();
		}
		else{
			$user = UserAccount::find($id);
			$user->update($data);
			if($edit->admin == 1 )
				$infor = "Administrator";
			else
				$infor = "Thành viên";
			UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Thành viên', $user->id,"Thay đổi quyền sử dụng thành viên " .$user->username. " thành: " .$infor);
			Session::put('success',"Đã thay đổi quyền sử dụng của thành viên ".$user->username." có ID: ".$user->id);
			return Redirect::back();
		}
	}

	public function postDetroyId($id,$back){
		$user = UserAccount::findOrFail($id);
		UserActivity::addActivity(Session::get('user'), 'Xóa', 'Thành viên', $user->id,"Tài khoản: " .$user->username. " --- \n Tên: " .$user->fullname. " --- \n Tên hiển thị: " .$user->creenname);
		Session::put('success',"Đã xóa thành viên ".$user->username." có ID: ".$user->id);
		UserAccount::destroy($id);
		$find = UserAccount::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			return Redirect::to("admin/user-accounts/information/{$find->id}");
		}
	}

	public function postDetroy(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn thành viên cần xóa");
			return Redirect::back();
		}
		else{
			foreach ($id as $key) {
				$user = UserAccount::findOrFail($key);
				UserActivity::addActivity(Session::get('user'), 'Xóa', 'Thành viên', $user->id,"Tài khoản: " .$user->username. " --- \n Tên: " .$user->fullname. " --- \n Tên hiển thị: " .$user->creenname);
				UserAccount::destroy($key);
			}
			Session::put('success',"Đã xóa các thành viên vừa chọn");
			return Redirect::back();
		}
	}

	public function getInformation($id){
		$show = UserAccount::findOrFail($id);
		return View::make('backend.user-accounts.show',compact('show'));
	}

	public function getData($admin){
   	$users = UserAccount::where('admin','=',$admin)
   	->select(array('user_accounts.id as id', 'user_accounts.username as username', 'user_accounts.admin as admin', 'user_accounts.fullname as fullname', 'user_accounts.creenname as creenname' , 'user_accounts.gender as gender'));

	return  Datatables::of($users)					  
                          ->add_column(
                          		'infor', 
                          		'<a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id) }}}" class="show_info_entry close block" style="float:left">
										@if($admin == 1)
											<img src="{{asset(\'assets/image/users/administartor.png\')}}" class="size40" alt="{{ $id }}">
						                @elseif($gender == "Nam")
											<img src="{{asset(\'assets/image/users/male.png\')}}" class="size40" alt="{{ $id }}">
						                @else
											<img src="{{asset(\'assets/image/users/female.png\')}}" class="size40" alt="{{ $id }}">
						                @endif
                          		</a>',0)	                      
                          ->edit_column('username', '{{{ Str::limit($username, 20, \'...\') }}}')
                          ->edit_column('fullname', '{{{ Str::limit($fullname, 20, \'...\') }}}')
                          ->edit_column('creenname', '{{{ Str::limit($creenname, 20, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/user-accounts/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',6)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',7)	                      
		                  ->remove_column('admin')
                          ->remove_column('gender')
		                  ->make();
    }

    public function getDataHidden(){
    	$users = UserAccount::select(array('user_accounts.id as id', 'user_accounts.username as username'));
		return  Datatables::of($users)					  
                          ->edit_column(
                          		'id','<a href="{{{ URL::to(\'admin/user-accounts/information/\' . $id) }}}" class="show_info_hidden close block em1_1" style="float:left">{{ $id }}</a>')	                      
                          ->edit_column('username', '{{{ Str::limit($username, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_hidden em1_1" href="{{{ URL::to(\'admin/user-accounts/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',6)	                      
                          ->add_column(
                          		'delete', 
                          		'	<form method="POST" action="{{{ URL::to(\'admin/user-accounts/detroy-id/\' . $id . \'/back\') }}}" style="display:inline">
										<a class="close delete em1_1" data-toggle="modal" href="#confirmDelete" data-title="Xóa thành viên" data-message="Bạn chắc chắn muốn xóa thành viên {{ $username }} có ID: {{ $id }} ?"><span class="glyphicon glyphicon-remove"></span></a>
									</form>
                          		',3)	
                          ->make();
    }
}

