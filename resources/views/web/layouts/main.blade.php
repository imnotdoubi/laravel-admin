<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@include('web.layouts.seo')
<link rel="bookmark" type="image/x-icon" href="/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<meta name="applicable-device" content="pc" />
<link href="/web/css/css.css" rel="stylesheet" type="text/css" />
@yield('res')
<script type="text/javascript" src="/web/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/js/kxbdSuperMarquee.js"></script>
<script src="/web/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="/web/js/index.js"></script>
</head>
<body>
<div class="topbar">
    <div class="box">
        <p class="left"><span>欢迎光临<strong>云海天</strong>！</span>
            @forelse(\Pcommon::headNewsCategory() as $v)
             <a href="/{{$v->typedir}}/">{{$v->typename}}</a>
            @empty
            @endforelse
        </p>
        <span class="right"><a href="/xm/">找项目</a><a href="/login">登录</a><a href="/register">注册</a></span>
    </div>
</div>
<div class="header">
    <div class="box">
    <div class="logo"><img src="/web/images/logo.png" /></div>
    <div class="search">
                <div class="search_tab">
                    <ul>
                        <li class="cur">找商机</li>
                         @forelse(\Pcommon::headInvest() as $k => $v)
                             @if($k > 0 && $k < 6)
                             <li><a href="/xm/{{$v->id}}/">{{$v->title}}</a></li>
                             @endif
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="search_box">
                    <form action="" method="get">
                        <input type="text" onblur="if (this.value == '') {this.value = this.attributes['def'].value;this.className='search_input';}" onfocus="if (this.value == this.attributes['def'].value) {this.value='';this.className='search_input1';}" def="想找什么项目？" class="search_input" value="想找什么项目？" name="search">
                        <input type="submit" class="search_btn" value="搜索">
                    </form>
                </div>
            </div>
            
    <ul class="header_icon">
        <li>
            <a href="/xm/" target="_blank" class="icon_a"></a>
            <a href="/xm/" target="_blank" class="text">项目库</a>
        </li>
        <li>
            <a href="/top.html" target="_blank" class="icon_b"></a>
            <a href="/top.html" target="_blank" class="text">排行榜</a>
        </li>
        <li class="center-right-item">
            <a href="/news/" target="_blank" class="icon_c"></a>
            <a href="/news/" target="_blank" class="text">资讯</a>
        </li>
    </ul>
    </div>
</div>
<!--Header End--->

<div class="menu">
<div class="box">
    <span class="open_menu">全部项目分类</span>
    <ul>
        <li><a href="/">首页</a></li>
        @forelse(\Pcommon::headCategory() as $v)
         <li><a href="/{{$v->typedir}}/">{{$v->typename}}</a></li>
        @empty
        @endforelse
    </ul>
</div>
</div>

 @yield('content')

<div class="links box clearfix"><span>友情链接：</span><a href="https://github.com/imnotdoubi" target="_blank">云海天</a></div>

<div class="footer">
    <div class="box clearfix">
    <div class="logo"><a href="#"><img src="/web/images/logo.png"  alt="" /></a></div>
    <div class="footer_right">
        <p><a href="#">关于我们</a>  |  <a href="#">免责声明</a>  |  <a href="#">友情链接</a>  |  <a href="#">联系我们</a>  </p>
        <p>版权所有：云海天</p>
        <p>友情提示：投资有风险，加盟须谨慎！</p>
    </div>
    </div>
</div>

</body>

</html>