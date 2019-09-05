<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@include('web.layouts.seo')
<link rel="bookmark" type="image/x-icon" href="/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
@if(Request::is('/'))
<link rel="alternate" media="only screen and(max-width: 640px)" href="{{env('APP_M_URL')}}" >
@else
@php
$query = $_GET?'?'.http_build_query($_GET):'';
@endphp
<link rel="alternate" media="only screen and(max-width: 640px)" href="{{env('APP_M_URL').'/'.request()->path()}}@if(!str_contains(request()->path(),'html') && !str_contains(request()->path(),'xml'))/@endif{!! $query !!}" >
@endif
<link href="/web/css/know.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>

</head>
<body>
<header>
	<div class="top">
        <a href="/" class="logo"></a>
        <a href="/" class="nav">首页</a>
        <a href="/know" class="nav">全部问题</a>
        {{-- <a href="/know" class="nav">待回答</a> --}}
        <div class="user">
        	      @forelse(\Pcommon::headCategory() as $k=> $v)
        	  @if($k<3)
	             <a href="/{{$v->typedir}}" class="log">{{$v->typename}}</a>
	             @endif
	            @empty
	            @endforelse
        </div>
      <div class="so">
          <input type="text" name="key" class="key" placeholder="请输入关键词">
          <input type="submit" class="sobut" value="搜索答案">
        </div>
  </div>
</header>

 @yield('content')


</body>

</html>