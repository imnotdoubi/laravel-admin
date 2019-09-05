@extends('web.layouts.mall_main') 
@section('title')
图库
@endsection
@section('res')
<link href="/web/mall/Agent/index.css" rel="stylesheet" type="text/css" /> @endsection @section('content')
<div class="bjlb-main">
	@forelse(\Pcommon::indexLeftCategory(19) as $k=>$v)
	<div class="rmtj">
		<div class="rmtj-title">
			<h2>{{$v->typename}}</h2>
			<p>{{$v->typename}}美图！
				<a href="/photo/{{$v->typedir}}"  style="padding-left:10px;">更多+</a>
			</p>
		</div>
		<div class="rmtj-body">
		@forelse(\Pcommon::photos($v->id) as $k =>$v2)
			@if($k == 0)
			<div class="body-left">
				<a href="{{\Pcommon::purl($v2->id)}}">
					<img src="{{config('app.upload')}}{{$v2->thumb}}" alt="{{$v2->title}}" />
				</a>
				<div class="img-bottom">
					<span>{{$v2->title}}</span>
					<p>
						<a href="{{\Pcommon::purl($v2->id)}}" >{{str_limit($v2->introduce,20)}}</a>
					</p>
				</div>
			</div>
			@endif
		@empty
		@endforelse
			<div class="body-right">
				<ul>
				@forelse(\Pcommon::photos($v->id) as $k =>$v2)
					@if($k > 0)
					<li>
						<a href="{{\Pcommon::purl($v2->id)}}"  title="{{$v2->title}}">
							<img src="{{config('app.upload')}}{{$v2->thumb}}"  />
						</a>
						<p>{{$v2->title}}</p>
					</li>
					@endif
				@empty
				@endforelse
				</ul>
			</div>
			<div class="clearfloat"></div>
		</div>
	</div>
 @empty
@endforelse 

</div>
@endsection