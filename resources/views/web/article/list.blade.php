@extends('web.layouts.main') 
@section('res')
	<link href="/web/css/list.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div style="background-color:#f7f7f7; padding-bottom:20px;">

	<div class="weizhi box">
		<a href="/">首页</a>&gt;<a href="/{{$pcate->typedir}}/">{{$pcate->typename}}&gt;<a href="/{{$head->typedir}}/">{{$head->typename}}</a>
	</div>

	<style type="text/css">
		.project_ph{ margin-top:0;}
	</style>

	<div class="box clearfix">
		<div class="w900">
	    	<div class="nav2">
	        	<ul class="clearfix">
	        	@forelse(\Pcommon::indexLeftCategory(15) as $k =>$v)
	        		@if($k < 5)
			        <li @if($v->typedir == $path)class='dq'@endif><a href="/news/{{$v->typedir}}/">{{$v->typename}}</a></li>
			        @endif
		        @empty
		        @endforelse
	            </ul>
	        </div>
	        <div class="news_list">
	        	<ul>
	        		@forelse($list as $v)
					<li class="clearfix">
	                	<a href="{{\Pcommon::nurl($v->id)}}" class="pic"><img src="{{config('app.upload')}}{{$v->conver}}" /></a>
	                    <strong><a href="{{\Pcommon::nurl($v->id)}}">{{$v->title}}</a></strong>
	                    <p>{{str_limit($v->description,120)}}</p>
	                    <span>更新时间：{{date('Y-m-d',strtotime($v->created_at))}}&nbsp;&nbsp;&nbsp;&nbsp;{{$v->hits}} 人阅读</span>
	                </li>
					@empty
					@endforelse
	            </ul>
	        </div>
	        
	        <div class="page_fenye"> 
	                   {!! \Pcommon::pagelink($list->links()) !!}
	            </div>
	    </div>
		
		@include('web.article.right')

	</div>

</div>
@endsection