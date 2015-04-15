<?php

class SoftwaresController extends BaseController {
	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$softwares = Software::paginate(10);
		$activities = UserActivity::where('target','=','Phần mềm')->orderBy("created_at","desc")->paginate(10);
		return View::make('softwares.index', compact('softwares','activities'));
	}

	public function getCreate(){
		$softwares = Software::paginate(10);
		return View::make('softwares.create',compact('softwares'));
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), Software::$rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		else{
			$new = Software::create($data);
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Phần mềm', $new->id,$new->name);
			Session::put('success',"Đã thêm phần mềm ".$new->name." có ID: ".$new->id);
			return Redirect::to("softwares/information/{$new->id}");
		}
	}

	public function getEdit($id){
		$softwares = Software::paginate(10);
		$softwarename= Software::all();
		if($id != 0)
			$softwarecheck= Software::findOrFail($id);
		return View::make('softwares.edit',compact('softwares','softwarename','softwarecheck'));
	}

	public function postEdit(){
		$validator = Validator::make($data = Input::all(), Software::$rules);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		else{
			$id=Input::get('id');
			if($id == 0){
				Session::put('fail',"Chọn phần mềm cần chỉnh sửa");
				return Redirect::to("softwares/edit/0");
			}
			else{
				$software = Software::findOrFail($id);
				$infor =$software->name;
				$software->update($data);
				UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Phần mềm', $software->id,$infor);
				Session::put('success',"Đã cập nhật phần mềm có ID: ".$software->id);
				return Redirect::to("softwares/information/{$software->id}");
			}
		}
	}

	public function getDelete($id){
		$softwares = Software::paginate(10);
		$softwarename= Software::all();
		if($id != 0)
			$softwarecheck= Software::findOrFail($id);
		return View::make('softwares.delete',compact('softwares','softwarename','softwarecheck'));
	}

	public function postDelete(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn phần mềm cần xóa");
			return Redirect::to("softwares/delete/0");
		}
		else{	
			$delete = Software::findOrFail($id);
			UserActivity::addActivity(Session::get('user'), 'Xóa', 'Phần mềm', $delete->id,$delete->name);
			Session::put('delete_success',"Đã xóa phần mềm ".$delete->name." có ID: ".$delete->id);
			Software::destroy($id);
			return Redirect::to("softwares/delete/0");
		}
	}

	public function getShow(){
		$softwares = Software::paginate(10);
		$softwarename= Software::all();
		return View::make('softwares.show',compact('softwares','softwarename'));
	}

	public function postShow(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn phần mềm cần xem thông tin");
			return Redirect::to("softwares/show");
		}
		else{
			return Redirect::to("softwares/information/{$id}");	
		}
	}

	public function getInformation($id){
		$show = Software::findOrFail($id);
		$softwares = Software::paginate(10);
		$comments= Comment::where('target','=','Phần mềm')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		$activities = UserActivity::where('target','=','Phần mềm')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		return View::make('softwares.information',compact('softwares','comments','activities','show'));
	}
}
