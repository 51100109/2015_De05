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

    public function postCheckEditusername($id){
		if(UserAccount::where('username','=', Input::get('username'))->whereNotIn('id', array($id))->count() > 0)
			return "false";
		else
			return "true";
	}
	
	public function postCheckEditemail($id){
        if(UserAccount::where('email','=', Input::get('email'))->whereNotIn('id', array($id))->count() > 0)
			return "false";
		else
			return "true";
    }

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.user-accounts.index', compact('system'));
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
			$data['password'] = Hash::make($data['password']);
			$user = UserAccount::create($data);
			UserActivity::addActivity(Auth::user()->id, 'Thêm', 'Thành viên', $user->id,"Tài khoản: " .$user->username. " --- \n Tên: " .$user->fullname. " --- \n Tên hiển thị: " .$user->creenname);
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
			if($user->admin == 1 )
				$infor = "Administrator";
			else
				$infor = "Thành viên";
			UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Thành viên', $user->id,"Thay đổi quyền sử dụng thành viên " .$user->username. " thành: " .$infor);
			Session::put('success',"Đã thay đổi quyền sử dụng của thành viên ".$user->username." có ID: ".$user->id);
			return Redirect::back();
		}
	}

	public function getEditAdmin($id){
        $user = UserAccount::find($id);
        return View::make('backend.admin.profile',compact('user'));
    
    }

    public function postEditAdmin($id){
        $validator = Validator::make($data = Input::all(), UserAccount::$rules_edit_admin);
        if ($validator->fails()){
            Session::put('fail',"Cập nhật không thành công");
            return Redirect::back();
        }
        else{
            $user = UserAccount::find($id);
            $data['password'] = Hash::make($data['password']);
            $user->update($data);
            UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Thành viên', $user->id,$user->username. " cập nhật thông tin cá nhân");
            Session::put('success',"Cập nhật thông tin thành công");
            return Redirect::back();
        }
    }

	public function getDelete($id){
		$user = UserAccount::find($id);
		$string = Str::limit($user->username, 150, '...');
		return View::make('backend.modals.delete_form', ['id'=>$user->id,'title'=>"thành viên",'item'=>"user-accounts",'content'=>$string]);
	}

	public function postDelete($id){
		$user = UserAccount::find($id);
		Session::put('success',"Đã xóa thành viên có ID: ".$id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Thành viên', $user->id,"Thành viên: ".$user->username);
		UserAccount::destroy($id);
		
		return Redirect::to("admin/user-accounts/index");
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
                          ->add_column('delete', '<a class="close delete delete_info_entry em1_4" href="{{{ URL::to(\'admin/user-accounts/delete/\' . $id) }}}"><span class="glyphicon glyphicon-trash"></span></a>',7)	                      
		                  ->remove_column('admin')
                          ->remove_column('gender')
		                  ->make();
    }
}

