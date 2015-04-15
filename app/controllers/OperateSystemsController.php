<?php

class OperateSystemsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$activities = UserActivity::where('target','=','Hệ điều hành')->orderBy("created_at","desc")->paginate(10);
		$systems = OperateSystem::paginate(10);
		return View::make('operate-systems.index', compact('systems','activities'));
	}

	public function getCreate(){
		$systems = OperateSystem::paginate(10);
		return View::make('operate-systems.create',compact('systems'));
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), OperateSystem::$rules, OperateSystem::$messages);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		else{
			$new = OperateSystem::create($data);
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Hệ điều hành', $new->id,$new->name);
			Session::put('success',"Đã thêm hệ điều hành ".$new->name." có ID: ".$new->id);
			return Redirect::to("operate-systems/information/{$new->id}");
		}
	}

	public function getEdit($id){
		$systems = OperateSystem::paginate(10);
		$systemname= OperateSystem::all();
		if($id != 0)
			$systemcheck= OperateSystem::findOrFail($id);
		return View::make('operate-systems.edit',compact('systems','systemname','systemcheck'));
	}

	public function postEdit(){
		$validator = Validator::make($data = Input::all(), OperateSystem::$rules,OperateSystem::$messages);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);}
		else{
			$id=Input::get('id');
			if($id == 0){
				Session::put('fail',"Chọn hệ điều hành cần chỉnh sửa");
				return Redirect::to("operate-systems/edit/0");
			}
			else{
				$system = OperateSystem::findOrFail($id);
				$infor =$system->name;
				$system->update($data);
				UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Hệ điều hành', $system->id,$infor);
				Session::put('success',"Đã cập nhật tên hệ điều hành ".$infor." thành ".$system->name." có ID: ".$system->id);
				return Redirect::to("operate-systems/information/{$system->id}");
			}
		}
	}

	public function getDelete($id){
		$systems = OperateSystem::paginate(10);
		$systemname= OperateSystem::all();
		if($id != 0)
			$systemcheck= OperateSystem::findOrFail($id);
		return View::make('operate-systems.delete',compact('systems','systemname','systemcheck'));
	}

	public function postDelete(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn hệ điều hành cần xóa");
			return Redirect::to("operate-systems/delete/0");
		}
		else{
			$delete = OperateSystem::find($id);
			UserActivity::addActivity(Session::get('user'), 'Xóa', 'Hệ điều hành', $delete->id,$delete->name);
			Session::put('delete_success',"Đã xóa hệ điều hành ".$delete->name." có ID: ".$delete->id);
			OperateSystem::destroy($id);
			return Redirect::to('operate-systems/delete/0');
		}
	}

	public function getShow(){
		$systems = OperateSystem::paginate(10);
		$systemname= OperateSystem::all();
		return View::make('operate-systems.show',compact('systems','systemname'));
	}

	public function postShow(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn hệ điều hành cần xem thông tin");
			return Redirect::to("operate-systems/show");
		}
		else{
			return Redirect::to("operate-systems/information/{$id}");	
		}
	}

	public function getInformation($id){
		$show = OperateSystem::find($id);
		$systems = OperateSystem::paginate(10);
		$activities = UserActivity::where('target','=','Hệ điều hành')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		return View::make('operate-systems.information',compact('systems','activities','show'));
	}
	
}
