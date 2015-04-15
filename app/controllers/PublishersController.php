<?php

class PublishersController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$publishers = Publisher::paginate(10);
		$activities = UserActivity::where('target','=','Nhà phát hành')->orderBy("created_at","desc")->paginate(10);
		return View::make('publishers.index', compact('publishers','activities'));
	}

	public function getCreate(){
		$publishers = Publisher::paginate(10);
		return View::make('publishers.create',compact('publishers'));
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), Publisher::$rules, Publisher::$messages);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		else{
			$new = Publisher::create($data);
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Nhà phát hành', $new->id,$new->name);
			Session::put('success',"Đã thêm nhà phát hành ".$new->name." có ID: ".$new->id);
			return Redirect::to("publishers/information/{$new->id}");
		}
	}

	public function getEdit($id){
		$publishers = Publisher::paginate(10);
		$publishername= Publisher::all();
		if($id != 0)
			$publishercheck= Publisher::findOrFail($id);
		return View::make('publishers.edit',compact('publishers','publishername','publishercheck'));
	}

	public function postEdit(){
		$validator = Validator::make($data = Input::all(), Publisher::$rules,Publisher::$messages);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		else{
			$id=Input::get('id');
			if($id == 0){
				Session::put('fail',"Chọn nhà phát hành cần chỉnh sửa");
				return Redirect::to("publishers/edit/0");
			}
			else{
				$publisher = Publisher::findOrFail($id);
				$infor =$publisher->name;
				$publisher->update($data);
				UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Nhà phát hành', $publisher->id,$infor);
				Session::put('success',"Đã cập nhật tên nhà phát hành ".$infor." thành ".$publisher->name." có ID: ".$publisher->id);
				return Redirect::to("publishers/information/{$publisher->id}");
			}
		}
	}

	public function getDelete($id){
		$publishers = Publisher::paginate(10);
		$publishername= Publisher::all();
		if($id != 0)
			$publishercheck= Publisher::findOrFail($id);
		return View::make('publishers.delete',compact('publishers','publishername','publishercheck'));
	}

	public function postDelete(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn nhà phát hành cần xóa");
			return Redirect::to("publishers/delete/0");
		}
		else{	
			$delete = Publisher::findOrFail($id);
			UserActivity::addActivity(Session::get('user'), 'Xóa', 'Nhà phát hành', $delete->id,$delete->name);
			Session::put('delete_success',"Đã xóa nhà phát hành ".$delete->name." có ID: ".$delete->id);
			Publisher::destroy($id);
			return Redirect::to("publishers/delete/0");
		}
	}

	public function getShow(){
		$publishers = Publisher::paginate(10);
		$publishername= Publisher::all();
		return View::make('publishers.show',compact('publishers','publishername'));
	}

	public function postShow(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn nhà phát hành cần xem thông tin");
			return Redirect::to("publishers/show");
		}
		else{
			return Redirect::to("publishers/information/{$id}");	
		}
	}

	public function getInformation($id){
		$show = Publisher::findOrFail($id);
		$publishers = Publisher::paginate(10);
		$activities = UserActivity::where('target','=','Nhà phát hành')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		return View::make('publishers.information',compact('publishers','activities','show'));
	}
}
