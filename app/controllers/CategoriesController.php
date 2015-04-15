<?php

class CategoriesController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function getIndex(){
		$categories = Category::paginate(10);
		$activities = UserActivity::where('target','=','Danh mục')->orderBy("created_at","desc")->paginate(10);
		return View::make('categories.index', compact('categories','activities'));
	}

	public function getCreate(){
		$categories = Category::paginate(10);
		return View::make('categories.create',compact('categories'));
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), Category::$rules, Category::$messages);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		else{
			$new = Category::create($data);

			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Danh mục', $new->id,$new->name);
			Session::put('success',"Đã thêm danh mục ".$new->name." có ID: ".$new->id);
			return Redirect::to("categories/information/{$new->id}");
		}
	}

	public function getEdit($id){
		$categories = Category::paginate(10);
		$categoryname= Category::all();
		if($id != 0)
			$categorycheck= Category::findOrFail($id);
		return View::make('categories.edit',compact('categories','categoryname','categorycheck'));
	}

	public function postEdit(){
		$validator = Validator::make($data = Input::all(), Category::$rules,Category::$messages);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		else{
			$id=Input::get('id');
			if($id == 0){
				Session::put('fail',"Chọn danh mục cần chỉnh sửa");
				return Redirect::to("categories/edit/0");
			}
			else{
				$category = Category::findOrFail($id);
				$infor =$category->name;
				$category->update($data);
				UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Danh mục', $category->id,$infor);
				Session::put('success',"Đã cập nhật tên danh mục ".$infor." thành ".$category->name." có ID: ".$category->id);
				return Redirect::to("categories/information/{$category->id}");
			}
		}
	}

	public function getDelete($id){
		$categories = Category::paginate(10);
		$categoryname= Category::all();
		if($id != 0)
			$categorycheck= Category::findOrFail($id);
		return View::make('categories.delete',compact('categories','categoryname','categorycheck'));
	}

	public function postDelete(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn danh mục cần xóa");
			return Redirect::to("categories/delete/0");
		}
		else{
			$delete = Category::findOrFail($id);
			UserActivity::addActivity(Session::get('user'), 'Xóa', 'Danh mục', $delete->id,$delete->name);
			Session::put('delete_success',"Đã xóa danh mục ".$delete->name." có ID: ".$delete->id);
			Category::destroy($id);
			return Redirect::to("categories/delete/0");
		}
	}

	public function getShow(){
		$categories = Category::paginate(10);
		$categoryname= Category::all();
		return View::make('categories.show',compact('categories','categoryname'));
	}

	public function postShow(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn danh mục cần xem thông tin");
			return Redirect::to("categories/show");
		}
		else{
			return Redirect::to("categories/information/{$id}");
		}	
	}

	public function getInformation($id){
		$show = Category::findOrFail($id);
		$categories = Category::paginate(10);
		$activities = UserActivity::where('target','=','Danh mục')->where('id_target','=',$id)->orderBy("created_at","desc")->paginate(10);
		return View::make('categories.information',compact('categories','activities','show'));
	}
}
