<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    @include('web.layouts.seo')
    <meta name="applicable-device" content="pc" />
    <link rel="stylesheet" href="/web/mall/NewIndex/css/reset.css" type="text/css" />
    <link rel="stylesheet" href="/web/mall/NewIndex/css/common.css" type="text/css" />
    <link rel="stylesheet" href="/web/mall/NewIndex/css/flash.css" type="text/css" />
    <link rel="stylesheet" href="/web/mall/NewIndex/css/companied.css" type="text/css" />
    <script src="/web/mall/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="/web/mall/js/companied.js" type="text/javascript"></script>
    <script src="/web/mall/js/NewIndex.js" type="text/javascript"></script>
    @yield('res')
</head>

<body>
    <div class="index-wrap">
        <div class="top-bar-bg">
            <div class="top-bar">
                <ul class="left-wrap">
                    <li style="color: #c30900;">欢迎光临云海天</li>
                   

                    @forelse(\Pcommon::headNewsCategory() as $v)
            <li> <a href="/{{$v->typedir}}/">{{$v->typename}}</a></li>
            @empty
            @endforelse
                </ul>
            
                <div class="clearfloat"> </div>
            </div>
        </div>
        <div class="logo-section">
            <div class="index-logo">
                <a href="/" title="云海天">
                    <img src="/web/images/logo.png" width="200" height="53" alt="云海天" title="云海天" />
                </a>
            </div>
            <font>@yield('title')</font>
            <div style="margin-left: 36px;" class="index-search">
                <ul class="index-serch-clssify">
                    <li>
                        <a style="color: #BD0000;" href="javascript:void(0);">产品</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">公司</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">展会</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">品牌</a>
                    </li>
                    <div class="clearfloat"> </div>
                </ul>
                <div class="index-search-ipt">
                    <input id="index-s-ipt" class="txt-ipt" type="text" name="searchInput" placeholder="请输入您要查询的产品名称" />
                    <input id="index-s-btn" class="txt-btn" type="button" name="searchBotton" value="搜索" />
                </div>
            </div>

  
            <div class="clearfloat"> </div>
        </div>
        <div class="index-nav-wrap">
            <div class="index-main-nav-bg">
                <ul class="index-main-nav">
                      <li><a href="/">首页</a></li>
                     @forelse(\Pcommon::headCategory() as $v)
                         <li><a href="/{{$v->typedir}}/">{{$v->typename}}</a></li>
                        @empty
                        @endforelse
                </ul>
            </div>
        </div>

        @yield('content')

        <div class="footer-bg">
            <p class="footer-txt">
                <a href="/" title="关于我们" target="_blank">关于我们</a>
                <a href="/" title="服务信息" target="_blank">服务信息</a>
                <a href="/" title="网站地图" target="_blank">网站地图</a>
            </p>
        </div>
        <div class="copyright">
            <p> 版权所有：云海天
               
            </p>
            友情提示：投资有风险，加盟须谨慎！
            </p>
         
        </div>
    </div>
</body>
</html>