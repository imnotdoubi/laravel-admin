@extends('web.layouts.mall_main') 
@section('title')
商城
@endsection
@section('res')
<link rel="stylesheet" href="/web/mall/NewIndex/css/reset.css" type="text/css" />
<link rel="stylesheet" href="/web/mall/NewIndex/css/common.css" type="text/css" />
<link rel="stylesheet" href="/web/mall/NewIndex/css/flash.css" type="text/css" />
<link rel="stylesheet" href="/web/mall/NewIndex/css/companied.css" type="text/css" />
<link href="/web/mall/NewIndex/css/GraphicsAndText.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
        $(document).ready(function () {
            $(".showArea").click(function () {
                var hideItem = $(".hideItem");
                var areaItem = $(".areaItem");
                if (areaItem.height() == 0) {
                    hideItem.stop().animate({ height: "80px" });
                    areaItem.stop().animate({ height: "80px" });
                } else {
                    hideItem.stop().animate({ height: "0px" });
                    areaItem.stop().animate({ height: "0px" });
                }
            });
        });
    </script>

@endsection
@section('content')
<div class="index-content-wrap">
	@include('web.mall.cate')
	<div class="center">
		<div class="centerleft">
			<ul>
			@forelse($list as $v)
				<li>
					<a href="{{\Pcommon::murl($v->id)}}"  title="{{$v->title}}">
						<img src="{{config('app.upload')}}{{$v->litpic}}" alt="{{$v->title}}" style="width: 210px; height: 201px;" />
					</a>
					<h3>
						<a href="{{\Pcommon::murl($v->id)}}"  title="{{$v->title}}"> {{str_limit($v->title,25)}}</a>
					</h3>
					<h4>
						<a href="{{\Pcommon::murl($v->id)}}"  > {{$v->brand}} </a>
					</h4>
					<p style="float: left; margin: 6px 0px 0px 10px;"> 价格：
						<span style="color: red; background-color: #fff; border-radius: 0;">{{$v->price}}</span>
					</p>
					<p> {{$v->provs->title}}</p>
				</li>
			@empty
			@endforelse
			</ul>
		</div>
		@include('web.mall.right')
		<div class="page" style="">
			<div class="pageLt pageLeft">【共
				<font color="#CC0000">{{$list->total()}}</font>条记录】
				<font color="#CC00000">
					<strong>{{$list->currentPage()}}</strong>
				</font>页/{{$list->lastPage()}}页</div>
			<div class="pageRt pageRight">
				{!! $links !!}
			</div>
		</div>
		<div class="clearfloat"> </div>
	</div>
</div>
@endsection