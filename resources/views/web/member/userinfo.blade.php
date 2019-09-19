@extends('web.member.layouts.main') @section('content')
<link rel="stylesheet" href="/web/member/public.css" />
<link rel="stylesheet" href="/web/member/user.css" />
<form name="form1" method="post" action="/member/userupdate" id="form1">
	{{ csrf_field() }}
	<div class="content_right_top clearfix">
		<h2 class="left"> 修改注册信息</h2>
	</div>
	<div class="clearfix person_com add_contact">
		{{-- <div id="test1" class="left" style="cursor:pointer;">
			<img src="{{$data['pic']}}" alt="" class="person_pic" />
			<a href="" class="change_pic">更换头像</a>
		</div> --}}
		<div class="message_edit">
			<table cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td width="80">
							<span class="ness right">用户名：</span>
						</td>
						<td style="text-align: left;"> {{$data['name']}} </td>
					</tr>
					<tr>
						<td width="80">
							<span class="ness">真实姓名：</span>
						</td>
						<td class="spantip">
							<input name="username" type="text" id="txtRealname" value="{{$data['username']}}" />
							<span id="txtRealnameTip"></span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="ness">联系电话：</span>
						</td>
						<td align="left" class="spantip">
							<input name="tel" type="text" id="txtTel" value="{{$data['tel']}}" />
							<span id="txtTelTip"></span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="right">QQ号码：</span>
						</td>
						<td class="spantip">
							<input name="qq" type="text" id="txtQQ" value="{{$data['qq']}}" />
							<span id="txtQQTip"></span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="right">微信号码：</span>
						</td>
						<td class="spantip">
							<input name="wx" type="text" id="txtwx" value="{{$data['wx']}}" />
							<span id="txtWxTip"></span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="right">电子邮箱：</span>
						</td>
						<td class="spantip">
							<input name="email" type="text" id="txtMail" style="width: 287px;" value="{{$data['email']}}" />
							<span id="txtMailTip"></span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="right">联系地址：</span>
						</td>
						<td>
							<input name="address" type="text" id="txtAddress" value="{{$data['address']}}" style="width: 287px;" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="submit_input clearfix pl250">
		<input type="submit" value="" name="Save" class="width122 sure122" />
		<span class="width122" onclick="reset()"></span>
	</div>

	@if(count($status) > 0)
            <span style="color: red; font-size: 18px;">{{$status}}</span>
    @endif
</form>

@endsection