@extends('front.layouts.mainlayout')

@section('title')
Kết quả tìm kiếm - Softsharing
@endsection

@section('content')
 <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <h1 class="content-subhead">Kết quả tìm kiếm</h1>
          <p>Từ khóa: {{{$keyword}}}</p>
        @if (count($softwares) === 0)
    		<p>Không tìm thấy kết quả nào</p>
		@else
    		@foreach ($softwares as $software)
    			@include('front.includes.softwareItem',['softwareItem'=>$software])
			@endforeach
			<div class="pull-right">{{ $softwares->appends(array('query' => $keyword))->links() }}</div>			
		@endif 
@endsection