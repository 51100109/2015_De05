<div class="head">     
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"  media="all" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}"  media="all" rel="stylesheet">
</div>

<?php $numCharacter = 300; ?>
<!--/row-->
<div class="body">
    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <!-- A wrapper for all the blog posts -->
            <div class="">           

                <!-- A single blog post -->
                <section class="post">
                    <header class="post-header">
                    	
                        <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" 
                        height="48" width="48" src="{{asset("{$softwareItem->image}")}}">

                        <h2 class="post-title">{{{$softwareItem->name}}}</h2>

                        <p class="post-meta">
                        	<a class="btn btn-success" href={{ URL::to('/software/'.$softwareItem->id) }}>
  							<i class="fa fa-download"></i> Download</a>                           	                        	
                        </p>
                        <p class="post-info">
                        	<i class="fa fa-info fa-lg"> {{{$softwareItem->filesize}}}MB ({{{$softwareItem->license}}})</i>
                        </p>						
                    </header>


                    <div class="post-description">
                    <p>{{{substr(strip_tags($softwareItem->description),0,$numCharacter)."..."}}}</p>
                    </div> 
                </section>                          
        </div>
    </div>
</div>
</div>
<!--/row-->
