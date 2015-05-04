<?php

class CategoriesController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function postCheckName(){
		if(Category::where('name','=', Input::get('name'))->count() > 0)
			return "false";
		else
			return "true";
	}

	public function getIndex(){
		return View::make('backend.categories.index');
	}

	public function getCreate(){
		return View::make('backend.categories.create');
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), Category::$rules);
		if ($validator->fails()){
			Session::put('fail',"Khởi tạo không thành công");
			return Redirect::back();
		}
		else{
			$category = Category::create($data);
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Danh mục', $category->id,"Danh mục ".$category->name." có ID: ".$category->id);
			Session::put('success',"Đã thêm danh mục ".$category->name." có ID: ".$category->id);
			return Redirect::back();
		}
	}

	public function getEdit($id){
		$category=Category::findOrFail($id);
		return View::make('backend.categories.edit',compact('category'));
	}

	public function postEdit($id){
		$validator = Validator::make($data = Input::all(), Category::$rules);
		if ($validator->fails()){
			Session::put('fail',"Cập nhật không thành công");
			return Redirect::back();
		}
		else{
			$category = Category::find($id);
			$infor =$edit->name;
			$category->update($data);
			UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Danh mục', $category->id,"Cập nhật tên danh mục ".$infor." thành ".$category->name);
			Session::put('success',"Đã cập nhật tên danh mục ".$infor." thành ".$category->name." có ID: ".$category->id);
			return Redirect::back();
		}
	}

	public function postDetroyId($id,$back){
		$category = Category::findOrFail($id);
		UserActivity::addActivity(Session::get('user'), 'Xóa', 'Danh mục', $category->id,"Danh mục ".$category->name." có ID: ".$category->id);
		Session::put('success',"Đã xóa danh mục ".$category->name." có ID: ".$category->id);
		Category::destroy($id);
		$find = Category::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			return Redirect::to("admin/categories/information/{$find->id}");
		}
	}

	public function postDetroy(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn danh mục cần xóa");
			return Redirect::back();
		}
		else{
			foreach ($id as $key) {
				$category = Category::findOrFail($key);
				UserActivity::addActivity(Session::get('user'), 'Xóa', 'Danh mục', $category->id,"Danh mục ".$category->name." có ID: ".$category->id);
				Category::destroy($key);
			}
			Session::put('success',"Đã xóa các danh mục vừa chọn");
			return Redirect::back();
		}
	}

	public function getInformation($id){
		$show = Category::findOrFail($id);
		return View::make('backend.categories.show',compact('show'));
	}

	public function getData(){
    	 $categories = Category::select(array('categories.image as image','categories.id as id', 'categories.name as name'));

		return  Datatables::of($categories)					  
                          ->edit_column(
                          		'image', 
                          		'<a href="{{{ URL::to(\'admin/categories/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{ $image }}" class="size32" alt="{{ $id }}">    
                          		</a>',0)	                      
                          ->edit_column('name', '{{{ Str::limit($name, 40, \'...\') }}}')
                          ->add_column('number', '{{ Software::where("id_category","=",$id)->count() }}',4)	                      
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/categories/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',5)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',6)	                      
		                  ->make();
    }

    public function getDataHidden(){
    	$categories = Category::select(array('categories.id as id','categories.name as name'));
		return  Datatables::of($categories)					  
                          ->edit_column('id', '<a href="{{{ URL::to(\'admin/categories/information/\' . $id) }}}" class="show_info_hidden close block em1_1" style="float:left">{{ $id }}</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_hidden em1_1" href="{{{ URL::to(\'admin/categories/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',3)	                      
                          ->add_column(
                          		'delete', 
                          		'	<form method="POST" action="{{{ URL::to(\'admin/categories/detroy-id/\' . $id . \'/back\') }}}" style="display:inline">
										<a class="close delete em1_1" data-toggle="modal" href="#confirmDelete" data-title="Xóa danh mục phần mềm" data-message="Bạn chắc chắn muốn xóa danh mục có ID: {{ $id }} ?"><span class="glyphicon glyphicon-remove"></span></a>
									</form>
                          		',4)	                      
		                  ->make();
    }
}
