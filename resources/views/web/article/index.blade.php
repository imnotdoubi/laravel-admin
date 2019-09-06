@extends('web.layouts.main') 
@section('res')
	
@endsection
@section('content')
<div class="box clearfix">
    <div class="title1"><strong>{{$head->typename}}</strong><span>
    </span></div>
    <div class="zx_right">
        <div class="bt2"><strong>最新资讯</strong></div>
        <ul>
        	@forelse(\Pcommon::indexNews() as $k=>$v)
                  <li>
                <span><a href="{{\Pcommon::nurl($v->id)}}"><img src="{{config('app.upload')}}{{$v->conver}}" /></a></span>
                <strong><a href="{{\Pcommon::nurl($v->id)}}">{{$v->title}}</a></strong>
                <p>{{str_limit($v->description,60,'')}}</p>
            </li>
             @empty
			@endforelse
        </ul>
    </div>
    
    <div class="zx_left">

    @forelse(\Pcommon::indexLeftCategory($head->id) as $k =>$pv)
    	@php
    		$newsArr =  \Pcommon::articles($pv->id);
    	@endphp
    	@if($pv->mid == 1)
		        <div class="zx_lb">
			        <div class="bt2"><a href="/{{$head->typedir}}/{{$pv->typedir}}">更多&gt;</a><strong>{{$pv->typename}}</strong></div>
			        <div class="tj">
			        	@forelse($newsArr as $k=>$v)
			        	@if($k == 0)
			               <span><a href="{{\Pcommon::nurl($v->id)}}"><img src="{{config('app.upload')}}{{$v->conver}}" /></a></span>
			            <strong><a href="{{\Pcommon::nurl($v->id)}}">{{$v->title}}</a></strong>
			            <p>{{str_limit($v->description,30,'')}}</p>
			            @endif
			             @empty
						@endforelse
			        </div>
			        <ul>
			        	@forelse($newsArr as $k=>$v)
			        	@if($k > 0)
			            <li><a href="{{\Pcommon::nurl($v->id)}}">{{$v->title}}</a></li>
			            @endif
			             @empty
						@endforelse
			        </ul>
			    </div>   
		@endif
    @empty
    @endforelse

    </div>
</div>

@endsection