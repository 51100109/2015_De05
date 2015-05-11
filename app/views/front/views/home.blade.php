@extends('front.layouts.mainlayout')

@section('title')
Home - Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
		<div class="row-fluid">        	
		   	<div class="col-xs-6">
		      <div class="table-responsive">
		         <table class="table table-curved table-striped">
		            <thead>
		               <tr>
		                  <th>
		                  	<div class="soft-date-homepage">
		                  		<i class="fa fa-clock-o content-subhead-homepage-clock"></i><a href={{ URL::to('/post/') }} style="color: #000000;"> Bài đăng mới nhất</a>
							</div>	
		                  </th>
		                  <th>
		                  	<div class="soft-date-homepage_1">
		                  		<i class="fa fa-calendar-o content-subhead-homepage-ca"></i> Cập nhật
		                  	</div>
		                  </th>                  
		               </tr>
		            <thead>
		            <tbody>
			            @if (count($posts) === 0)
			    			<tr>
				                <td colspan="2">
									<h1>No post</h1>									
								</td>
			            	</tr>  
						@else
			               @foreach ($posts as $post)				    		
				    			@include('front.includes.homepagePost',['postItem'=>$post])				    		
							@endforeach 
							<tr>
				                <td colspan="2">
									<a href={{ URL::to('/post/') }} class="view-more">Xem thêm</a>				
								</td>
			            	</tr>
			            @endif              
		            </tbody>
		         </table>
		      </div>
		   </div>

		   <div class="col-xs-6">
		      <div class="table-responsive">
		         <table class="table table-curved table-striped">
		            <thead>
		               <tr>
		                  <th> 
		                  	<div class="soft-date-homepage">
		                  		<i class="fa fa-clock-o content-subhead-homepage-clock"></i><a href={{ URL::to('/softwares/') }} style="color: #000000;"> Phần mềm mới nhẩt</a>
							</div>	
		                  </th>
		                  <th> 
		                  	<div class="soft-date-homepage_1">
		                  		<i class="fa fa-calendar-o content-subhead-homepage-ca"></i> Cập nhật
		                  	</div>
		                  </th>                  
		               </tr>
		            <thead>
		            <tbody>
		                @if (count($softwares) === 0)
			    			<tr>
				                <td colspan="2">								
									<h1>No software</h1>									
								</td>
			            	</tr>  
						@else
			               @foreach ($softwares as $software)				    		
				    			@include('front.includes.homepageSoft',['softwareItem'=>$software])				    		
							@endforeach         
			                <tr>
				                <td colspan="2">
					                <a href={{ URL::to('/softwares/') }} class="view-more">Xem thêm</a>
								</td>
			            	</tr>
						@endif
		             </tbody>               
		         </table>
		      </div>
		   </div>
		</div>		
@endsection