@extends('admin.index')

@section('hidden')
	<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Mục Phần Mềm</h3>
                </div>

                @if ($categories->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Danh mục</th>
								<td class="border"></td>
								<td class="border"></td>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
					        <tr >
					            <td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
	                            <td><a href="<?php echo asset("categories/information/{$category->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("categories/edit/{$category->id}"); ?>" class="block"><span class="glyphicon glyphicon-edit"></span></a></td>
								<td><a href="<?php echo asset("categories/delete/{$category->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$categories->links()}}
			        </div>
				</div>
				@else
					<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
			</div>
@stop