@extends('admin.index')

@section('hidden')
	<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Hệ Điều Hành</h3>
                </div>

                @if ($systems->count())
				<div class="panel-body">
					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Hệ Điều Hành</th>
								<td class="border"></td>
								<td class="border"></td>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($systems as $system)
					        <tr >
					            <td>{{ $system->id }}</td>
								<td>{{ $system->name }}</td>
	                            <td><a href="<?php echo asset("operate-systems/information/{$system->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("operate-systems/edit/{$system->id}"); ?>" class="block"><span class="glyphicon glyphicon-edit"></span></a></td>
								<td><a href="<?php echo asset("operate-systems/delete/{$system->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$systems->links()}}
			        </div>
				</div>
				@else
					<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
			</div>
@stop