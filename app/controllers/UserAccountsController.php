<?php

class UserAccountsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function postCheckUsername(){
		if(!UserAccount::check_username(Input::get('username')))
			return "true";
		else
			return "false";
	}
	
	public function postCheckEmail(){
        if(!UserAccount::check_email(Input::get('email')))
			return "true";
		else
			return "false";
    }

	public function getIndex(){
		$users = UserAccount::paginate(10);
		$admin_activities = UserActivity::where('target','=','Thành viên')->orderBy("created_at","desc")->paginate(10);

		$user_activities = UserActivity::selected(0,10);
		return View::make('user-accounts.index', compact('users','admin_activities','user_activities'));
	}

	public function getCreate(){
		$users = UserAccount::paginate(10);
		return View::make('user-accounts.create',compact('users'));
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), UserAccount::$rules);
		if ($validator->fails()){
			return Redirect::back();
		}
		else{
			$new = UserAccount::create($data);
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Thành viên', $new->id,$new->name);
			Session::put('success',"Đã thêm thành viên ".$new->name." có ID: ".$new->id);
			return Redirect::to("user-accounts/information/{$new->id}");
		}
	}

	public function getDelete($id){
		$users = UserAccount::paginate(10);
		$username= UserAccount::where('admin','=',0)->get();
		if($id != 0)
			$usercheck= UserAccount::findOrFail($id);
		return View::make('user-accounts.delete',compact('users','username','usercheck'));
	}

	public function postDelete(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn tài khoản cần xóa");
			return Redirect::to("user-accounts/delete/0");
		}
		else{	
			$delete = UserAccount::findOrFail($id);
			UserActivity::addActivity(Session::get('user'), 'Xóa', 'Thành viên', $delete->id,$delete->username);
			Session::put('delete_success',"Đã xóa thành viên ".$delete->name." có ID: ".$delete->id);
			UserAccount::destroy($id);
			return Redirect::to("user-accounts/delete/0");
		}
	}

	public function getShow(){
		$users = UserAccount::paginate(10);
		$username= UserAccount::paginate(10);
		return View::make('user-accounts.show',compact('users','username'));
	}

	public function postShow(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn tài khoản cần xem thông tin");
			return Redirect::to("user-accounts/show");
		}
		else{
			return Redirect::to("user-accounts/information/{$id}");	
		}
	}

	public function getInformation($id){
		$show = UserAccount::findOrFail($id);
		$users = UserAccount::paginate(10);
		$activities = UserActivity::where('id_user','=',$id)->orderBy("created_at","desc")->paginate(10);
		return View::make('user-accounts.information',compact('users','activities','show'));
	}
}

