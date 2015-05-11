<div class="head">     
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"  media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}"  media="all" rel="stylesheet">
</div>
<?php $numCharacter = 20; ?>
<tr>
<td>
<img class="post-avatar-homepage" height="25" width="25" src="{{asset("{$softwareItem->image}")}}">

<a href={{ URL::to('/software/'.$softwareItem->id) }}>
	<div class="post-title-homepage" data-toggle="tooltip" data-placement="left" title="{{{$softwareItem->name}}}"> {{{substr(strip_tags($softwareItem->name),0,$numCharacter)}}}</div>
</a>
</td>
<td>
<div class="post-date-homepage"> {{{ date("d M y" ,strtotime($softwareItem->updated_at)) }}}</div>
</td>
</tr>