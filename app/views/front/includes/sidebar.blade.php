<?php 
	$categories = Category::all();
?>

<div class="panel panel-default">
	 	<div class="panel-heading"> Danh mục </div>
	     <div class="list-group">
	     	@foreach ($categories as $category)
    			<a href={{ URL::to('/category/'.$category->id) }} class="list-group-item">{{{ $category->name}}}</a>
			@endforeach
    </div>
</div>