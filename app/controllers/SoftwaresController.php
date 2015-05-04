<?php

class SoftwaresController extends BaseController {
	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		return View::make('backend.softwares.index');
	}

	public function getCreate(){
		$publisher = Publisher::all();
		$system = OperateSystem::all();
		return View::make('backend.softwares.create',compact('publisher','system'));
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), Software::$rules);
		if ($validator->fails()){
			Session::put('fail',"Khởi tạo không thành công");
			return Redirect::back();
		}
		else{
			$software = Software::create($data);
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Phần mềm', $software->id,$software->name);
			Session::put('success',"Đã thêm phần mềm ".$software->name." có ID: ".$software->id);
			return Redirect::back();
		}
	}

	public function getEdit($id){
		$software = Software::findOrFail($id);
		$publisher = Publisher::all();
		$system = OperateSystem::all();
		return View::make('backend.softwares.edit',compact('software','publisher','system'));
	}

	public function postEdit($id){
		$validator = Validator::make($data = Input::all(), Software::$rules);
		if ($validator->fails()){
			Session::put('fail',"Cập nhật không thành công");
			return Redirect::back();
		}
		else{
			$software = Software::findOrFail($id);
			$infor =$software->name;
			$software->update($data);
			UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Phần mềm', $software->id,$infor);
			Session::put('success',"Đã cập nhật phần mềm có ID: ".$software->id);
			return Redirect::back();
		}
	}

	public function postDetroyId($id,$back){
		$software = Software::findOrFail($id);
		UserActivity::addActivity(Session::get('user'), 'Xóa', 'Phần mềm', $software->id,"Phần mềm ".$software->name." có ID: ".$software->id);
		Session::put('success',"Đã xóa phần mềm ".$software->name." có ID: ".$software->id);
		Software::destroy($id);
		$find = Software::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			return Redirect::to("admin/softwares/information/{$find->id}");
		}
	}

	public function postDetroy(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn phần mềm cần xóa");
			return Redirect::back();
		}
		else{
			foreach ($id as $key) {
				$software = Software::findOrFail($key);
				UserActivity::addActivity(Session::get('user'), 'Xóa', 'Phần mềm', $software->id,"Phần mềm ".$software->name." có ID: ".$software->id);
				Software::destroy($key);
			}
			Session::put('success',"Đã xóa các phần mềm vừa chọn");
			return Redirect::back();
		}
	}

	public function getInformation($id){
		$show = Software::findOrFail($id);
		$view = UserActivity::where('id_target','=',$show->id)->where('target','=','Phần mềm')->where('activity','=','Xem thông tin')->count();
		$number_comments = Comment::where('target','=','Phần mềm')->where('id_target','=',$show->id)->count();
		return View::make('backend.softwares.show',compact('view','number_comments','show'));
	}

	public function getData(){
    	 $softwares = Software::leftjoin('categories', 'categories.id', '=','softwares.id_category')
    	 					->leftjoin('publishers', 'publishers.id', '=','softwares.id_publisher')
    	 					->leftjoin('operate_systems', 'operate_systems.id', '=','softwares.id_system')
    	 				    ->select(array('softwares.image as image', 'softwares.id as id', 'softwares.name as name','publishers.name as name_publisher','operate_systems.name as name_system','categories.name as name_category'));

		return  Datatables::of($softwares)					  
                          ->edit_column(
                          		'image', 
                          		'<a href="{{{ URL::to(\'admin/softwares/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{ $image }}" class="size40" alt="{{ $id }}">
                          		</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->edit_column('name_publisher', '{{{ Str::limit($name_publisher, 10, \'...\') }}}')
                          ->edit_column('name_system', '{{{ Str::limit($name_system, 10, \'...\') }}}')
                          ->edit_column('name_category', '{{{ Str::limit($name_category, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',7)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',8)	                      
		                  ->make();
    }

    public function getDataHidden(){
    	$softwares = Software::select(array('softwares.id as id','softwares.name as name'));
		return  Datatables::of($softwares)					  
                          ->edit_column('id', '<a href="{{{ URL::to(\'admin/softwares/information/\' . $id) }}}" class="show_info_hidden close block em1_1" style="float:left">{{ $id }}</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_hidden em1_1" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',3)	                      
                          ->add_column(
                          		'delete', 
                          		'	<form method="POST" action="{{{ URL::to(\'admin/softwares/detroy-id/\' . $id . \'/back\') }}}" style="display:inline">
										<a class="close delete em1_1" data-toggle="modal" href="#confirmDelete" data-title="Xóa phần mềm" data-message="Bạn chắc chắn muốn xóa phần mềm có ID: {{ $id }} ?"><span class="glyphicon glyphicon-remove"></span></a>
									</form>
                          		',4)	                      
		                  ->make();
    }

    public function getDataCategory($id){
    	 $softwares = Software::where('softwares.id_category','=',$id)
    	 					->leftjoin('publishers', 'publishers.id', '=','softwares.id_publisher')
    	 					->leftjoin('operate_systems', 'operate_systems.id', '=','softwares.id_system')
    	 				    ->select(array('softwares.image as image', 'softwares.id as id', 'softwares.name as name','publishers.name as name_publisher','operate_systems.name as name_system'));

		return  Datatables::of($softwares)					  
                          ->edit_column(
                          		'image', 
                          		'<a href="{{{ URL::to(\'admin/softwares/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{ $image }}" class="size40" alt="{{ $id }}">
                          		</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->edit_column('name_publisher', '{{{ Str::limit($name_publisher, 10, \'...\') }}}')
                          ->edit_column('name_system', '{{{ Str::limit($name_system, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',7)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',8)	                      
		                  ->make();
    }

    public function getDataPublisher($id){
    	 $softwares = Software::where('softwares.id_publisher','=',$id)
    	 					->leftjoin('categories', 'categories.id', '=','softwares.id_category')
    	 					->leftjoin('operate_systems', 'operate_systems.id', '=','softwares.id_system')
    	 				    ->select(array('softwares.image as image', 'softwares.id as id', 'softwares.name as name','operate_systems.name as name_system','categories.name as name_category'));

		return  Datatables::of($softwares)					  
                          ->edit_column(
                          		'image', 
                          		'<a href="{{{ URL::to(\'admin/softwares/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{ $image }}" class="size40" alt="{{ $id }}">
                          		</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->edit_column('name_system', '{{{ Str::limit($name_system, 10, \'...\') }}}')
                          ->edit_column('name_category', '{{{ Str::limit($name_category, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',7)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',8)	                      
		                  ->make();
    }

    public function getDataSystem($id){
    	 $softwares = Software::where('softwares.id_system','=',$id)
    	 					->leftjoin('publishers', 'publishers.id', '=','softwares.id_publisher')
    	 					->leftjoin('categories', 'categories.id', '=','softwares.id_category')
    	 				    ->select(array('softwares.image as image', 'softwares.id as id', 'softwares.name as name','publishers.name as name_publisher','categories.name as name_category'));

		return  Datatables::of($softwares)					  
                          ->edit_column(
                          		'image', 
                          		'<a href="{{{ URL::to(\'admin/softwares/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{ $image }}" class="size40" alt="{{ $id }}">
                          		</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->edit_column('name_publisher', '{{{ Str::limit($name_publisher, 10, \'...\') }}}')
                          ->edit_column('name_category', '{{{ Str::limit($name_category, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',7)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',8)	                      
		                  ->make();
    }
}
