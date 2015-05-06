<?php

class OperateSystemsController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function postCheckName(){
		if(OperateSystem::where('name','=', Input::get('name'))->count() > 0)
			return "false";
		else
			return "true";
	}

	public function postCheckEditname($id){
		if(OperateSystem::where('name','=', Input::get('name'))->whereNotIn('id', array($id))->count() > 0)
			return "false";
		else
			return "true";
	}

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.operate-systems.index', compact('system'));
	}

	public function getCreate(){
		$category = Category::all();
		return View::make('backend.operate-systems.create',compact('category'));
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), OperateSystem::$rules);
		if ($validator->fails()){
			Session::put('fail',"Khởi tạo không thành công");
			return Redirect::back();
		}
		else{
			$id_nums = Input::get('id_category');
			$id_nums = implode(PHP_EOL, $id_nums);
			$system = new OperateSystem;
			$system->name = Input::get('name');
			$system->image = Input::get('image');
			$system->id_category = $id_nums;
			$system->save();
			UserActivity::addActivity(Auth::user()->id, 'Thêm', 'Hệ điều hành', $system->id,"Hệ điều hành ".$system->name." có ID: ".$system->id);
			Session::put('success',"Đã thêm hệ điều hành ".$system->name." có ID: ".$system->id);
			return Redirect::back();
		}
	}

	public function getEdit($id){
		$category = Category::all();
		$system= OperateSystem::findOrFail($id);
		return View::make('backend.operate-systems.edit',compact('system','category'));
	}

	public function postEdit($id){
		$validator = Validator::make($data = Input::all(), OperateSystem::$rules_edit);
		if ($validator->fails()){
			Session::put('fail',"Cập nhật không thành công");
			return Redirect::back();
		}
		else{
			$id_nums = Input::get('id_category');
			$id_nums = implode(PHP_EOL, $id_nums);
			$system = OperateSystem::findOrFail($id);
			$system->name = Input::get('name');
			$system->image = Input::get('image');
			$system->id_category = $id_nums;
			$system->save();
			UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Hệ điều hành', $system->id,"Cập nhật hệ điều hành ".$system->name." có ID: ".$system->id);
			Session::put('success',"Đã cập nhật hệ điều hành ".$system->name." có ID: ".$system->id);
			return Redirect::back();
		}
	}

	public function postDetroyId($id,$back){
		$system = OperateSystem::findOrFail($id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Hệ điều hành', $system->id,"Hệ điều hành ".$system->name." có ID: ".$system->id);
		Session::put('success',"Đã xóa hệ điều hành ".$system->name." có ID: ".$system->id);
		OperateSystem::destroy($id);
		$find = OperateSystem::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			if(!empty($find))
				return Redirect::to("admin/operate-systems/information/{$find->id}");
			else
				return Redirect::to("admin/operate-systems/create");
		}
	}

	public function postDetroy(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn hệ điều hành cần xóa");
			return Redirect::back();
		}
		else{
			foreach ($id as $key) {
				$system = OperateSystem::findOrFail($key);
				UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Hệ điều hành', $system->id,"Hệ điều hành ".$system->name." có ID: ".$system->id);
				OperateSystem::destroy($key);
			}
			Session::put('success',"Đã xóa các hệ điều hành vừa chọn");
			return Redirect::back();
		}
	}

	public function getInformation($id){
		$show = OperateSystem::find($id);
		return View::make('backend.operate-systems.show',compact('show'));
	}
	
	public function getData(){
    	 $systems = OperateSystem::select(array('operate_systems.image as image','operate_systems.id as id', 'operate_systems.name as name'));

		return  Datatables::of($systems)					  
                          ->edit_column(
                          		'image', 
                          		'<a href="{{{ URL::to(\'admin/operate-systems/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{ $image }}" class="size40" alt="{{ $id }}">    
                          		</a>',0)	                      
                          ->edit_column('name', '{{{ Str::limit($name, 40, \'...\') }}}')
                          ->add_column('number', '{{ Software::where("id_system","=",$id)->count() }}',4)	      
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/operate-systems/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',5)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',6)	                      
		                  ->make();
    }
}
