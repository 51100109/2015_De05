<?php

class PublishersController extends BaseController {

	public function __construct(){
    	$this->beforeFilter('check-admin');
	}

	public function postCheckName(){
		if(Publisher::where('name','=', Input::get('name'))->count() > 0)
			return "false";
		else
			return "true";
	}

	public function postCheckEditname($id){
		if(Publisher::where('name','=', Input::get('name'))->whereNotIn('id', array($id))->count() > 0)
			return "false";
		else
			return "true";
	}

	public function getIndex(){
		$system = OperateSystem::all();
		return View::make('backend.publishers.index', compact('system'));
	}

	public function getCreate(){
		return View::make('backend.publishers.create');
	}

	public function postCreate(){
		$validator = Validator::make($data = Input::all(), Publisher::$rules);
		if ($validator->fails()){
			Session::put('fail',"Khởi tạo không thành công");
			return Redirect::back();
		}
		else{
			$publisher = Publisher::create($data);
			UserActivity::addActivity(Auth::user()->id, 'Thêm', 'Nhà phát hành', $publisher->id,"Nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
			Session::put('success',"Đã thêm nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
			return Redirect::back();
		}
	}

	public function getEdit($id){
		$publisher= Publisher::findOrFail($id);
		return View::make('backend.publishers.edit',compact('publisher'));
	}

	public function postEdit($id){
			$publisher = Publisher::find($id);
			$infor =$publisher->name;
			$publisher->update($data);
			UserActivity::addActivity(Auth::user()->id, 'Chỉnh sửa', 'Nhà phát hành', $publisher->id,"Cập nhật tên nhà phát hành ".$infor." thành ".$publisher->name);
			Session::put('success',"Đã cập nhật nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
			return Redirect::back();
	}

	public function postDetroyId($id,$back){
		$publisher = Publisher::findOrFail($id);
		UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Nhà phát hành', $publisher->id,"Nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
		Session::put('success',"Đã xóa nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
		Publisher::destroy($id);
		$find = Publisher::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			if(!empty($find))
				return Redirect::to("admin/publishers/information/{$find->id}");
			else
				return Redirect::to("admin/publishers/create");
		}
	}

	public function postDetroy(){
		$id = Input::get('id');
		if($id == 0){
			Session::put('fail',"Chọn nhà phát hành cần xóa");
			return Redirect::back();
		}
		else{
			foreach ($id as $key) {
				$publisher = Publisher::findOrFail($key);
				UserActivity::addActivity(Auth::user()->id, 'Xóa', 'Nhà phát hành', $publisher->id,"Nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
				Publisher::destroy($key);
			}
			Session::put('success',"Đã xóa các nhà phát hành vừa chọn");
			return Redirect::back();
		}
	}

	public function getInformation($id){
		$show = Publisher::findOrFail($id);
		return View::make('backend.publishers.show',compact('show'));
	}

	public function getData(){
    	 $publishers = Publisher::select(array('publishers.id as id', 'publishers.name as name'));

		return  Datatables::of($publishers)					  
                          ->add_column(
                          		'infor', 
                          		'<a href="{{{ URL::to(\'admin/publishers/information/\' . $id) }}}" class="show_info_entry close" style="float:left">
									<img src="{{asset(\'assets/image/publishers/publisher_icon.png\')}}" class="size40" alt="{{ $id }}">    
                          		</a>',0)	                      
                          ->edit_column('name', '{{{ Str::limit($name, 40, \'...\') }}}')
                          ->add_column('number', '{{ Software::where("id_publisher","=",$id)->count() }}',4)	      
                          ->add_column('edit', '<a class="close block edit_info_entry em1_4" href="{{{ URL::to(\'admin/publishers/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',5)	                      
                          ->add_column('delete', '<input type="checkbox" name="id[]" id="id" value="{{$id}}" class="close check_box_20">',6)	                      
		                  ->make();
    }
}
