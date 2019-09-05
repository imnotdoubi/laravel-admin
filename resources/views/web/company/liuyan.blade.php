@extends('web.company.main') @section('content')
<div class="submain ht">
	<div class="current">当前位置：
		<a href="{{env('APP_URL')}}" target="_blank">中国名酒招商网</a> >>
		<a href="{{$company->url()}}" target="_blank">{{$company->title}}</a> >> 在线留言
	</div>
	<script src="/web/js/getCity.js" type="text/javascript"></script>
	<script src="/web/js/Verification/Verification.js" type="text/javascript"></script>
	<script src="/web/js/VCode.js" type="text/javascript"></script>
	@include('web.company.components.message')
	<script type="text/javascript">
		function SetTextBoxHtml(e) {
			var txt = $(e).text();
			$(e).parent().children().removeClass("selected");
			$("textarea[id$=contTextBox]").val(txt);
			$(e).addClass("selected");
		}
	</script>
	<input type="hidden" name="ctl00$CompanyContact$ContacUsShowHiddenField" id="ctl00_CompanyContact_ContacUsShowHiddenField"
	    value="1" />
	@include('web.company.components.contact')
	<div class="service">
		<div class="sideservicert">
			<div class="sideservicelt">
				<ul>
					<li style="border-top:0px;">
						<a href="http://wpa.qq.com/msgrd?v=3&uin=2881711614&site=qq&menu=yes" target="_blank">
							<img src="http://wpa.qq.com/pa?p=2:2881711614:41" alt="QQ">
						</a>
						<span>客服一部</span> 电话：021-80333878 QQ：2881711614 </li>
					<li class="slogan">选择7999让您酒销全球，携手7999财富应有尽有！　7999中国名酒招商网</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection