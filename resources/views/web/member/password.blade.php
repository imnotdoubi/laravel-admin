@extends('web.member.layouts.main') 
@section('content')
<link rel="stylesheet" href="/web/member/layui.css" />
<link rel="stylesheet" href="/web/member/public.css" />
<link rel="stylesheet" href="/web/member/user.css" />
<link type="text/css" rel="stylesheet" href="/web/member/formValidator/style/validator.css" />
<form name="form1" method="post" action="/member/passwords" id="form1">
	{{ csrf_field() }}
	<div class="content_right_top clearfix">
		<h2 class="left"> 修改密码</h2>
	</div>
	<div class="clearfix person_com change_psw">
		<div class="message_edit left">
			<table cellpadding="0" cellspacing="0" width="740">
				<tbody>
					<tr style="background: #e7e7e7;">
						<td width="140"> 您的会员用户名是： </td>
						<td class="align_left" style="color: #f00;" width="265"> {{auth('web')->user()->name}} </td>
						<td></td>
					</tr>
					<tr>
						<td>
							<span class="ness">旧密码：</span>
						</td>
						<td>
							<input type="password" id="txtoldpwd" name="oldpassword" required autofocus>
						</td>
						<td class="align_left left">
							<div id="txtoldpwdTip"></div>
						</td>
					</tr>
					<tr>
						<td>
							<span class="ness">新密码：</span>
						</td>
						<td>
							<input type="password" id="txtnewpwd" name="password" required autofocus>
						</td>
						<td class="align_left  spantip left" id="psw_reg">
							<div id="txtnewpwdTip"></div>
						</td>
					</tr>
					<tr>
						<td>
							<span class="ness">确认新密码：</span>
						</td>
						<td>
							<input type="password" id="txtnewpwd1" name="password_confirmation" required autofocus>
						</td>
						<td class="align_left  spantip left">
							<div id="txtnewpwd1Tip"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="submit_input clearfix pl195">
		<input type="submit" value="" name="Save" class="sure122" />
		<span class="width141 sure122" onclick="reset()"></span>
	</div>
</form>

@if(count($status) > 0)
            <span style="color: red; font-size: 18px;">{{$status}}</span>
    @endif
@endsection