@extends('admin.index')

@section('hidden')
		<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Nhà Phát Hành</h3>
                </div>

                @if ($publishers->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Nhà Phát Hành</th>
								<td class="border"></td>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($publishers as $publisher)
					        <tr >
					            <td>{{ $publisher->id }}</td>
								<td>{{ $publisher->name }}</td>
	                            <td><a href="<?php echo asset("publishers/information/{$publisher->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("publishers/edit/{$publisher->id}"); ?>" class="block"><span class="glyphicon glyphicon-edit"></span></a></td>
								<td><a href="<?php echo asset("publishers/delete/{$publisher->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$publishers->links()}}
			        </div>
				</div>
				@else
					<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
			</div>
@stop