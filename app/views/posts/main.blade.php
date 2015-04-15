@extends('admin.index')

@section('hidden')
			<div class="panel panel-primary" style="margin:0;padding:0">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Bài Đăng</h3>
                </div>

                @if ($posts->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Tiêu Đề</th>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($posts as $post)
					        <tr >
					            <td>{{ $post->id }}</td>
								<td>{{ $post->title }}</td>
	                            <td><a href="<?php echo asset("posts/information/{$post->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("posts/delete/{$post->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$posts->links()}}
			        </div>
				</div>
				@else
					<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
			</div>
@stop
