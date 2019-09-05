@extends('web.layouts.main') 
@section('res')
	<link href="/web/css/list.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@php
	if($pcate->parent_id == 0)
		$tid = $pcate->id;
	else
		$tid = $pcate->parent_id;
	$turl = $pcate->typedir;
@endphp
<div style="background-color:#f7f7f7; padding-bottom:20px;">
	<div class="weizhi box">
		<a href="/">首页</a>&gt;<a href="/{{$head->typedir}}">{{$head->typename}}</a>
	</div>
	<div class="box clearfix">
		 <!--左侧开始-->
	    <div class="about_l">
	    	<div class="hd"></div>
	        <div class="bd">
	            <ul>
	            @forelse(\Pcommon::indexLeftCategory($tid) as $k =>$v)
			        <li @if($v->typedir == $path)class='cur'@endif><a href="/{{$turl}}/{{$v->typedir}}/">{{$v->typename}}</a></li>
		        @empty
		        @endforelse
	            </ul>
	        </div>
	    </div>
	    <!--左侧结束-->
		
	    <!--右侧开始-->
	    <div class="about_r">
	    	<div class="hd">{{$head->typename}}</div>
	        <div class="bd">
	        	{!! $head->content !!}
	        </div>
	    </div>
	    <!--右侧结束-->
	</div>
</div>
@endsection