@extends('web.member.layouts.main')
@section('content')
<link rel="stylesheet" href="/web/member/user.css" />
<link type="text/css" rel="stylesheet" href="/web/js/formValidator/style/validator.css" />
<form name="form1" method="post" action="/member/sell{{$id}}" id="form1">
	{{ csrf_field() }}
	<div class="content_right_top clearfix">
		<h2 class="left"> 供应信息编辑</h2>
	</div>
	@include('web.member.sell._form')
</form>
@endsection