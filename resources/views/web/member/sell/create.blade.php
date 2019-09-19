@extends('web.member.layouts.main')
@section('content')
<link rel="stylesheet" href="/web/member/layui/css/layui.css" />
<link rel="stylesheet" href="/web/member/public.css" />
<link rel="stylesheet" href="/web/member/user.css" />
<link type="text/css" rel="stylesheet" href="/web/member/validator.css" />
<form name="form1" method="post" action="/member/sellstore" id="form1">
	{{ csrf_field() }}
	<div class="content_right_top clearfix">
		<h2 class="left"> 供应信息添加</h2>
	</div>
	@include('web.member.sell._form')
</form>
@endsection