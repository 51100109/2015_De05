@extends('admin.index')

@section('hidden')
			<div class="panel panel-primary" style="margin:0;padding:0">
                <div class="panel-heading">
                    <h3 class="panel-title">Danh Sách Bình Luận</h3>
                </div>

                @if ($comments->count())
				<div class="panel-body">

					<table class="table table-hover tablesorter">
						<thead>
							<tr>    
					        	<th>ID</th>
								<th>Người đăng</th>
								<td class="border"></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($comments as $comment)
					        <tr >
					            <td>{{ $comment->id }}</td>
								<td>
					            	@if(!empty( UserAccount::find($comment->id_user)))
					            		{{ UserAccount::find($comment->id_user)->username }}
					            	@else
										[ Không tồn tại ]
					            	@endif
					            </td>
	                            <td><a href="<?php echo asset("comments/information/{$comment->id}"); ?>" class="block"><span class="glyphicon glyphicon-info-sign"></span></a></td>
								<td><a href="<?php echo asset("comments/delete/{$comment->id}"); ?>" class="block"><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
			            {{$comments->links()}}
			        </div>
				</div>
				@else
					<div class="panel-body">
						Chưa có thông tin.
					</div>
				@endif
			</div>
@stop
