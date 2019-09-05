@extends('web.layouts.mall_main') 
@section('res')
<link href="/web/mall/Agent/public.css" rel="stylesheet" type="text/css" />
<link href="/web/mall/Agent/secondzhaoshang.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="subnav10">
	<div class="left home">
		<img src="/web/mall/images/sc_03.gif" />
	</div>
	<ul class="left Nav">
		<li>
			<a href="/" >首页</a>
		</li>
		<li>
			<a href="/photo/{{$photos->typedir}}/"> {{$photos->typename}}</a>
		</li>
	</ul>
</div>
<div class="zslistcont ht">
	<div class="zslsttitl">
		<div class="zslistlt left">
			<div class="zslist11 left"> </div>
			<div class="zslist22 left">
				<span> {{$photos->typename}}</span>列表</div>
			<div class="zslist33 left"> </div>
		</div>
	</div>
	<div class="zhaoslist">
		<div class="zhaoslistcont">
			<ul>
			@forelse($list as $v)
				<li>
					<a href="{{\Pcommon::purl($v->id)}}" title="{{$v->title}}">
						<img src="{{config('app.upload')}}{{$v->thumb}}" />
					</a>
					<div>
						<a href="{{\Pcommon::purl($v->id)}}"  title="{{$v->title}}"> {{$v->title}}</a>
					</div>
				</li>
			@empty
			@endforelse
			</ul>
		</div>
		<div class="page">
			<div class="pageLt pageLeft">【共{{$list->total()}}条记录】
				<font color="">
					<strong>{{$list->currentPage()}}</strong>
				</font>页/{{$list->lastPage()}}页
				<font color="">
					<strong>20</strong>
				</font>条/页</div>
			<div class="pageRt pageRight">
				{!! $links !!}
			</div>
		</div>
	</div>
</div>
@endsection