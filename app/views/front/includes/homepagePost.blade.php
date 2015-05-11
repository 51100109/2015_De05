<div class="head">     
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"  media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}"  media="all" rel="stylesheet">
</div>
<?php $numCharacter = 30; ?>
<tr>
	<td>
		<a href={{ URL::to('/post/'.$postItem->id) }} >
			<div class="post-title-homepage " data-toggle="tooltip" data-placement="left" title="{{{$postItem->title}}}"><i class="fa fa-file-text"></i> {{{$postItem->title}}}</div>
		</a>
	</td>
	<td>
		<div class="post-date-homepage"> {{{ date("d M y" ,strtotime($postItem->updated_at)) }}}</div>
	</td>
</tr>