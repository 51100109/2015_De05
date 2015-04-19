<?php $numCharacter = 600; ?>

<div class="row">
	<div>
		<h2>{{{$softwareItem->name}}}</h2>
<!-- 		<p>{{substr(htmlspecialchars($softwareItem->description),0,$numCharacter)."..."}}</p> -->
		<p>{{{substr($softwareItem->description,0,$numCharacter)."..."}}}</p>
		<p>
			<a class="btn btn-default" href={{ URL::to('/software/'.$softwareItem->id) }} role="button">View details »</a>
		</p>
	</div>
</div>
<!--/row-->