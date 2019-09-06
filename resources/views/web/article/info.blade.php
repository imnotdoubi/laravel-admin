@extends('web.layouts.main')
@section('res')
<link href="/web/css/list.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div style="background-color:#f7f7f7; padding-bottom:20px;">

	<div class="weizhi box">
		<a href="/">首页</a>&gt;{{$categorys->typename}}
	</div>

	<style type="text/css">
		.project_ph{ margin-top:0;}
	</style>

	<div class="box clearfix">
		<div class="w900">
	    	<div class="news_cn">
	    	<h1>{{$head->title}}</h1>
	        <div class="news_cn_time">更新时间：{{$head->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;来源：云海天&nbsp;&nbsp;&nbsp;&nbsp;阅读：{{$head->hits}}次</div>
	        <div class="content">
	   	     	<!--在你自己的服务器请去掉替换-->
			{!! str_replace('src="/upload','src="http://47.98.200.91/upload',$head->content) !!}
	        </div>
	        
	        <div class="page_sx clearfix">
	        	<span class="page_sx_pre">
					@if($pre_news)
						<a href="{{\Pcommon::nurl($pre_news->id)}}"><i>{{$pre_news->title}}</i></a>
						@else
						没有了
						@endif
	        		</span>
	            <span class="page_sx_next">
	            	@if($next_news)
						<a href="{{\Pcommon::nurl($next_news->id)}}"><i>{{$next_news->title}}</i></a>
						@else
						没有了
					@endif</span>
	        </div>
	        </div>
	        
	        
	        @include('web.article.message')
	      
	    
	   	</div>

		@include('web.article.right')

	</div>
	
</div>



@endsection