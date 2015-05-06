<?php

class SoftwaresController extends BaseController {
	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.softwares.index', compact('system'));
	}

	public function getCategory($id_system,$id_category){
		$system = OperateSystem::all();
		$op_system = OperateSystem::find($id_system);
		$category= Category::find($id_category);
		return View::make('backend.softwares.filter', compact('system','op_system','category'));
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
			UserActivity::addActivity(Auth::user()->id, 'Thêm', 'Phần mềm', $software->id,"Phần mềm ".$software->name." có ID: ".$software->id);
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
			$software->update($data);
			UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Phần mềm', $software->id,"Cập nhật phần mềm ".$software->name." có ID: ".$software->id);
			Session::put('success',"Đã cập nhật phần mềm có ID: ".$software->id);
			return Redirect::back();
		}
	}

	public function postDetroyId($id,$back){
		$software = Software::findOrFail($id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Phần mềm', $software->id,"Phần mềm ".$software->name." có ID: ".$software->id);
		Session::put('success',"Đã xóa phần mềm ".$software->name." có ID: ".$software->id);
		Software::destroy($id);
		$find = Software::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			if(!empty($find))
				return Redirect::to("admin/softwares/information/{$find->id}");
			else
				return Redirect::to("admin/softwares/create");
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
				UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Phần mềm', $software->id,"Phần mềm ".$software->name." có ID: ".$software->id);
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
                          ->edit_column(
                          		'name_publisher', 
                          		' 	@if(!empty($name_publisher))
                          				{{{ Str::limit($name_publisher, 10, \'...\') }}}
									@else
										[ ... ]
									@endif
                          		')
                          ->edit_column(
                          		'name_system', 
                          		'	@if(!empty($name_system))
                          				{{{ Str::limit($name_system, 10, \'...\') }}}
                          			@else
										[ ... ]
									@endif
                          		')
                          ->edit_column(
                          		'name_category', 
                          		'	@if(!empty($name_category))
                          				{{{ Str::limit($name_category, 10, \'...\') }}}
                          			@else
										[ ... ]
									@endif
                          		')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',7)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',8)	                      
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
                          ->edit_column(
                          		'name_publisher', 
                          		' 	@if(!empty($name_publisher))
                          				{{{ Str::limit($name_publisher, 10, \'...\') }}}
									@else
										[ ... ]
									@endif
                          		')
                          ->edit_column(
                          		'name_system', 
                          		'	@if(!empty($name_system))
                          				{{{ Str::limit($name_system, 10, \'...\') }}}
                          			@else
										[ ... ]
									@endif
                          		')
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
                          ->edit_column(
                          		'name_system', 
                          		'	@if(!empty($name_system))
                          				{{{ Str::limit($name_system, 10, \'...\') }}}
                          			@else
										[ ... ]
									@endif
                          		')
                          ->edit_column(
                          		'name_category', 
                          		'	@if(!empty($name_category))
                          				{{{ Str::limit($name_category, 10, \'...\') }}}
                          			@else
										[ ... ]
									@endif
                          		')
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
                          ->edit_column(
                          		'name_publisher', 
                          		' 	@if(!empty($name_publisher))
                          				{{{ Str::limit($name_publisher, 10, \'...\') }}}
									@else
										[ ... ]
									@endif
                          		')
                          ->edit_column(
                          		'name_category', 
                          		'	@if(!empty($name_category))
                          				{{{ Str::limit($name_category, 10, \'...\') }}}
                          			@else
										[ ... ]
									@endif
                          		')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',7)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',8)	                      
		                  ->make();
    }

    public function getDataItem($id_system,$id_category){
    	 $softwares = Software::where('softwares.id_system','=',$id_system)
    	 					->where('softwares.id_category','=',$id_category)
    	 					->leftjoin('publishers', 'publishers.id', '=','softwares.id_publisher')
    	 				    ->select(array('softwares.image as image', 'softwares.id as id', 'softwares.name as name','publishers.name as name_publisher'));

		return  Datatables::of($softwares)					  
                          ->edit_column(
                          		'image', 
                          		'<a href="{{{ URL::to(\'admin/softwares/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{ $image }}" class="size40" alt="{{ $id }}">
                          		</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->edit_column(
                          		'name_publisher', 
                          		' 	@if(!empty($name_publisher))
                          				{{{ Str::limit($name_publisher, 10, \'...\') }}}
									@else
										[ ... ]
									@endif
                          		')
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/softwares/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',6)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',7)	                      
		                  ->make();
    }
}
