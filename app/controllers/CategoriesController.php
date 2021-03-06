<?php

class CategoriesController extends BaseController {

	public function __construct(){
		$this->beforeFilter('auth');
    	$this->beforeFilter('check-admin');
	}

	public function postCheckJs(){
	    if( strip_tags(Purifier::clean(Input::get('image'))) !=  Input::get('image'))
	      return "false";
	    else
	      return "true";
	  }

	public function postCheckName(){
		if((Category::where('name','=', Input::get('name'))->count() > 0)||(strip_tags(Purifier::clean(Input::get('name'))) !=  Input::get('name')))
			return "false";
		else
			return "true";
	}

	public function postCheckEditname($id){
		if((Category::where('name','=', Input::get('name'))->whereNotIn('id', array($id))->count() > 0)||(strip_tags(Purifier::clean(Input::get('name'))) !=  Input::get('name')))
			return "false";
		else
			return "true";
	}

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.categories.index',compact('system'));
	}

	public function getCreate(){
		return View::make('backend.categories.create');
	}

	public function postCreate(){
		$data = Input::all();
	    $data["image"]=strip_tags(Purifier::clean($data["image"]));
	    $data["name"]=strip_tags(Purifier::clean($data["name"]));
		if(($data["image"] != Input::get('image')) || ($data["name"] != Input::get('name'))){
			Session::put('fail',"Khởi tạo không thành công");
			return Redirect::back();
		}
		else{
			$validator = Validator::make($data, Category::$rules);
			if ($validator->fails()){
				Session::put('fail',"Khởi tạo không thành công");
				return Redirect::back();
			}
			else{
				$category = Category::create($data);
				UserActivity::addActivity(Auth::user()->id, 'Thêm', 'Danh mục', $category->id,"Danh mục ".$category->name." có ID: ".$category->id);
				Session::put('success',"Đã thêm danh mục ".$category->name." có ID: ".$category->id);
				return Redirect::back();
			}
		}
	}

	public function getEdit($id){
		$category=Category::findOrFail($id);
		return View::make('backend.categories.edit',compact('category'));
	}

	public function postEdit($id){
		$data = Input::all();
	    $data["image"]=strip_tags(Purifier::clean($data["image"]));
	    $data["name"]=strip_tags(Purifier::clean($data["name"]));
		if(($data["image"] != Input::get('image')) || ($data["name"] != Input::get('name'))){
			Session::put('fail',"Cập nhật không thành công");
			return Redirect::back();
		}
		else{
			$validator = Validator::make($data, Category::$rules_edit);
			if ($validator->fails()){
				Session::put('fail',"Cập nhật không thành công");
				return Redirect::back();
			}
			else{
				$category = Category::find($id);
				$category->update($data);
				UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Danh mục', $category->id,"Cập nhật danh mục ".$category->name." có ID: ".$category->id);
				Session::put('success',"Đã cập nhật danh mục ".$category->name." có ID: ".$category->id);
				return Redirect::back();
			}
		}
	}

	public function getDelete($id){
		$category = Category::find($id);
		$string = Str::limit($category->name, 150, '...');
		$counter = Software::where('id_category','=',$id)->count();
		return View::make('backend.modals.delete_form', ['id'=>$category->id,'title'=>"danh mục",'item'=>"categories",'content'=>$string,'counter'=>$counter]);
	}

	public function postDelete($id){
		$category = Category::find($id);
		$systems = OperateSystem::all();
		foreach ($systems as $system) {
	        $string1 = str_replace( $category->id, '', $system->id_category );
	        $string2 = str_replace( PHP_EOL.PHP_EOL, PHP_EOL, $string1 );
	        $system->id_category = $string2;
	        $system->save();
		}

        Session::put('success',"Đã xóa danh mục có ID: ".$id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Danh mục', $category->id,"Danh mục: ".$category->name);
		Category::destroy($id);
		return Redirect::to("admin/categories/index");
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
                          ->edit_column('name', '{{{ Str::limit($name, 30, \'...\') }}}')
                          ->add_column('number', '{{ Software::where("id_category","=",$id)->count() }}',4)	                      
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/categories/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',5)	                      
                          ->add_column('delete', '<a class="close delete delete_info_entry em1_4" href="{{{ URL::to(\'admin/categories/delete/\' . $id) }}}"><span class="glyphicon glyphicon-trash"></span></a>',6)	                      
		                  ->make();
    }
}
