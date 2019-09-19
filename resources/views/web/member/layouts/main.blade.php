<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>云海天B2B商城-个人中心</title>
	<link rel="stylesheet" href="/web/member/public.css" />
	<link rel="stylesheet" href="/web/member/blue.css" />
	<script type="text/javascript" src="/web/member/jquery.js"></script>
	<script type="text/javascript" src="/web/member/jquery.artDialog.js"></script>
	<script type="text/javascript" src="/web/member/common.js" charset="utf-8"></script>
	<script type="text/javascript" src="/web/member/tips.js"></script>
	<script src="/web/member/MemberCenter.js" type="text/javascript"></script>

    <script src="/web/member/toastr.js"></script>
    <link rel="stylesheet" href="/web/member/toastr.min.css">

</head>
@php
	$user = auth('web')->user();
	$day = number_format(ceil((strtotime(auth('web')->user()->endTime) - time()) / 60 / 60 / 24));
@endphp
<body>
	<div class="wrap pos_rel">
		<!-- 页面头部-header.html -->
		<div class="header">
			<div class="head_top">
				<div class="center_width clearfix">
					<div class="left"> 欢迎{{auth('web')->user()->name}}来到会员管理中心！</div>
					<div class="right">
						<a href="/logout/" title="安全退出" class="bac_none">
							<span class="quit"> 安全退出</span>
						</a>
						<a href="/member/" title="会员首页">
							<span class="member"> 会员首页</span>
						</a>
						<a target="_blank" href="/" title="网站首页">
							<span class="wrap_index"> 网站首页</span>
						</a>
						<a target="_blank" href="/news/" title="资讯">资讯</a>
						<a target="_blank" href="/sell/" title="求购">求购</a>
						<a target="_blank" href="/xm/" title="招商">招商</a>
						<a target="_blank" href="/know/" title="产品">问答</a>
					</div>
				</div>
			</div>
		</div>
		<!-- 页面内容 -->
		<div class="content">
			<div class="center_width clearfix">
				<!-- 左侧公用部分-content_left -->
				<div class="left content_left content_left_max" id="menu">
					<h2>{{auth('web')->user()->name}} 的会员中心</h2>
					<ul>

						<li>
							<div>
								<h3> 基本信息管理</h3>
							</div>
							<ul>
								<li>
									<a href="/member/password/" title="修改密码">修改密码</a>
								</li>
								<li>
									<a href="/member/userinfo/" title="个人信息">个人信息</a>
								</li>
							</ul>
						</li>
						
						<li>
							<div>
								<h3> 信息发布与管理</h3>
							</div>
							<ul>
								<li>
									<a href="/member/sell/" title="产品信息管理">供应列表</a>
									<a href="/member/sell/create/" class="right">添加</a>
								</li>
	
								<li>
									<a href="/member/xm/" > 项目列表</a>
									<a href="/member/xm/create/" class="right">添加</a>
								</li>
								<li>
									<a href="/member/news/" > 新闻列表</a>
									<a href="/member/news/create/" class="right">添加</a>
								</li>
								<li>
									<a href="/member/mall/"> 商城列表</a>
									<a href="/member/mall/create/" class="right">添加</a>
								</li>

							</ul>
						</li>

						<li>
							<div>
								<h3> 寻求商机</h3>
							</div>
							<ul>
								<li>
									<a target="_blank" href="/mall">商城</a>
								</li>
								<li>
									<a target="_blank" href="/xm">项目</a>
								</li>
								<li>
									<a target="_blank" href="/sell">供应信息</a>
								</li>
								<li>
									<a target="_blank" href="/know">问答</a>
								</li>
								<li>
									<a href="/photo" title="代理意向">图库</a>
								</li>
							</ul>
						</li>
					</ul>

				</div>
				<div class="right content_right">
					@yield('content')
				</div>
			</div>
		</div>
		<!-- 页面底部-bottom.html -->
		<div class="footer mart ht">
			<div class="footer mart ht">
				
				<div> 版权所有：云海天 
					<br /> 
				 本站只起到信息平台作用,不为交易经过负任何责任
				
				</div>
			</div>
		</div>
	</div>
</body>

</html>