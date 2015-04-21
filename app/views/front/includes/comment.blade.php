<?php 
	if (Auth::check())
	{
		$idUser = Auth::user()->id;
	}
	$idTarget = $software->id;
	$url = URL::to('comment');
	
	if ($isSoftware)
	{
		$matchThese = ['target' => 'Phần mềm', 'id_target' => $idTarget];
		
	}
	else 
	{
		$matchThese = ['target' => 'Bài đăng', 'id_target' => $idTarget];
	}
	$comments = Comment::where($matchThese)->get()->reverse();
?>

<div class="row">

	<div class="row">
		<!-- 		comment box -->
		<div class="col-md-12">
			<div class="form-group">
				<h3>Bình luận:</h3>
				@if (Auth::check())
				<div class="row">
					<div class="col-md-10">
						<textarea id="commentBox" style="resize: none"
							class="form-control" rows="5" id="comment"></textarea>
					</div>
					<div class="col-md-2"
						style="margin-bottom: 18px; position: absolute; bottom: 0; right: 0;">
						<button type="button" class="btn btn-primary btn-block"
							onclick="postComment(<?php echo $idUser.",".$isSoftware.",".$idTarget.","."'".$url."'" ?>)">Đăng</button>
					</div>
				</div>
				@else
				<div class="well">
					<a href="{{asset('login')}}">Đăng nhập </a>để bình luận!
				</div>
				@endif
			</div>
		</div>
	</div>


	<div class="row">
		<!-- 		display comments -->
		<div class="col-md-12">
			<div class="detailBox">
				<div class="titleBox">
					<label>Các bình luận</label>
				</div>

				<div class="actionBox">
					<ul class="commentList">
						@if (count($comments) == 0)
							<p>Chưa có bình luận nào</p>
						@else
							@foreach ($comments as $comment)
								<?php 
									$curUser = User::find($comment->id_user);
									$curUserName = $curUser->username;
									$curTime = $comment->created_at;
								?>
    							<li>
									<p class="commentHead">{{{$curUserName}}}</p>
									<div class="commentText">
										<p class="">{{{$comment->content}}}</p>
										<span class="date sub-text">{{{$curTime}}}</span>
										@if (Auth::check())
											@if ($comment->id_user == $idUser)
												<span class="date sub-text"><a style=" cursor: pointer;" onclick="deleteComment(<?php echo "'".$url."/".($comment->id)."'" ?>)">Delete</a></span>
											@endif
										@endif
									</div>
								</li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>