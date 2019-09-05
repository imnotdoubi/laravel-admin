@extends('web.layouts.main')
@section('title')
图库
@endsection
@section('res')
<link href="/web/css/list.css" rel="stylesheet" type="text/css" />
<link href="/web/mall/Agent/zzsc.css" rel="stylesheet" type="text/css" />
<script src="/web/mall/js/move.js" type="text/javascript"></script>
@endsection @section('content')
<div style="background-color:#f7f7f7; padding-bottom:20px;">

	<div class="weizhi box">
		<a href="/">首页</a>&gt;图库
	</div>

	<div class="box clearfix">
		<div class="w900">
	    	<div class="news_cn">
	    	<h1>{{$photo->title}}</h1>
	        <div class="news_cn_time">更新时间：{{$photo->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;来源：云海天&nbsp;&nbsp;&nbsp;&nbsp;阅读：{{$photo->hits}}次</div>
	        <div class="content">
	   	     	<div id="playimages" class="play">
					<ul class="big_pic">
						<div class="prev"></div>
					    <div class="next"></div>
					    
					    <div class="length">{{$photo->introduce}}</div>
					    
					    <a class="mark_left" href="javascript:;"></a>
					    <a class="mark_right" href="javascript:;"></a>
					    <div class="bg"></div>
					    
					    @forelse($photo->conver as $k=>$v)
		                	<li style="z-index:1;"><img src="{{config('app.upload')}}{{$v}}" /></li>
						@empty
						@endforelse
					    </ul>
					    <div id="small_pic" class="small_pic">
					    	<ul style="width:400px;">
					    		 @forelse($photo->conver as $k=>$v)
				                	<li style=" filter: alpha(opacity:100); opacity:1;"><img src="{{config('app.upload')}}{{$v}}" /></li>
								@empty
								@endforelse
					        </ul>       
					    </div>
					</div>
					
	        </div>

	        </div>
	   	</div>

		<div class="w260">

			<div class="project2">
				<div class="bt"><a href="/photo" class="more">更多&gt;&gt;</a>图库推荐</div>
				<ul>
					@forelse(\Pcommon::photos($photo->parent_id) as $k=>$v)
		            	<li>
							<a href="{{\Pcommon::purl($v->id)}}" class="pic"><img src="{{config('app.upload')}}{{$v->thumb}}" /></a>
							<span class="tit"><a href="{{\Pcommon::purl($v->id)}}">{{$v->title}}</a></span>
							<p>热度：{{$v->hits}}</p>
							<a href="{{\Pcommon::purl($v->id)}}" class="btn">立即预览</a>
						</li>
		             @empty
					@endforelse

				</ul>
			</div>
			
		</div>

	</div>
	
</div>


@endsection