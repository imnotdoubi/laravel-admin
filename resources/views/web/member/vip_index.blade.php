@extends('web.member.layouts.main') 
@section('content')
<link rel="stylesheet" href="/web/member/user.css" />
<div class="logip">
	<div class="remind">
		<a >您好！您的账号本次登录【{{$log[0]->created_at}}】 @if(isset($log[1]))/上次登录【IP：{{$log[1]->ip}}  {{$log[1]->created_at}}】 @endif</a>
	</div>
	<div class="warning"> </div>
</div>

<div class="comp_info">
	<h3>基本信息</h3>
	<div>
		<ul>
			<li>
				<span>用户名：</span>
				<b>{{$user->name}}</b>
			</li>
			<li>
				<span>邮箱名：</span>
				<b>{{$user->email}}</b>
			</li>
			<li>
				<span>个人信息完整：</span>
				<b class="pos_rel">
					<span class="gray_span">
						<span class="yellow_span" id="fina_dre_width" style="width: 68%;"></span>
					</span>
				</b>
				<span style="width: 30px; padding-left: 10px; text-align: center;" id="fina_dre">88%</span>
				<a href="/member/userinfo/">[补充]</a>
			</li>
		</ul>
	</div>
</div>
@endsection