@extends('admin.index')

@section('hidden')
			<div class="panel panel-primary" style="margin:0;padding:0">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Thành Viên</h3>
                </div>

                @if ($users->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Tài Khoản</th>
								<td class="border"></td>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
					        <tr >
					            <td>{{ $user->id }}</td>
								<td>{{ $user->username }}</td>
	                            <td><a href="<?php echo asset("user-accounts/information/{$user->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("user-accounts/delete/{$user->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$users->links()}}
			        </div>
				</div>
				@else
					<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
			</div>
@stop
