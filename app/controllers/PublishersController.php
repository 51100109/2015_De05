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

	public function getIndex(){
		return View::make('backend.publishers.index');
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
			UserActivity::addActivity(Session::get('user'), 'Thêm', 'Nhà phát hành', $publisher->id,"Nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
			Session::put('success',"Đã thêm nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
			return Redirect::back();
		}
	}

	public function getEdit($id){
		$publisher= Publisher::findOrFail($id);
		return View::make('backend.publishers.edit',compact('publisher'));
	}

	public function postEdit($id){
		$validator = Validator::make($data = Input::all(), Publisher::$rules);
		if ($validator->fails()){
			Session::put('fail',"Cập nhật không thành công");
			return Redirect::back();
		}
		else{
			$publisher = Publisher::find($id);
			$infor =$publisher->name;
			$publisher->update($data);
			UserActivity::addActivity(Session::get('user'), 'Chỉnh sửa', 'Nhà phát hành', $publisher->id,"Cập nhật tên nhà phát hành ".$infor." thành ".$publisher->name);
			Session::put('success',"Đã cập nhật tên nhà phát hành ".$infor." thành ".$publisher->name." có ID: ".$publisher->id);
			return Redirect::back();
		}
	}

	public function postDetroyId($id,$back){
		$publisher = Publisher::findOrFail($id);
		UserActivity::addActivity(Session::get('user'), 'Xóa', 'Nhà phát hành', $publisher->id,"Nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
		Session::put('success',"Đã xóa nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
		Publisher::destroy($id);
		$find = Publisher::get()->first();
		if($back=='back'){
			return Redirect::back();
		}
		else if($back=='next'){
			return Redirect::to("admin/publishers/information/{$find->id}");
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
				UserActivity::addActivity(Session::get('user'), 'Xóa', 'Nhà phát hành', $publisher->id,"Nhà phát hành ".$publisher->name." có ID: ".$publisher->id);
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

    public function getDataHidden(){
    	$publishers = Publisher::select(array('publishers.id as id','publishers.name as name'));
		return  Datatables::of($publishers)					  
                          ->edit_column('id', '<a href="{{{ URL::to(\'admin/publishers/information/\' . $id) }}}" class="show_info_hidden close block em1_1" style="float:left">{{ $id }}</a>')	                      
                          ->edit_column('name', '{{{ Str::limit($name, 10, \'...\') }}}')
                          ->add_column('edit', '<a class="close block edit_info_hidden em1_1" href="{{{ URL::to(\'admin/publishers/edit/\' . $id) }}}"><span class="glyphicon glyphicon-edit"></span></a>',3)	                      
                          ->add_column(
                          		'delete', 
                          		'	<form method="POST" action="{{{ URL::to(\'admin/publishers/detroy-id/\' . $id . \'/back\') }}}" style="display:inline">
										<a class="close delete em1_1" data-toggle="modal" href="#confirmDelete" data-title="Xóa nhà phát hành" data-message="Bạn chắc chắn muốn xóa nhà phát hành có ID: {{ $id }} ?"><span class="glyphicon glyphicon-remove"></span></a>
									</form>
                          		',4)	                      
		                  ->make();
    }
}
