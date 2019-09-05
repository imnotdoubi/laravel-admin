@extends('web.layouts.mall_main') 
@section('title')
产品库
@endsection
@section('res')
<link href="/web/mall/NewIndex/css/product.css" rel="stylesheet" type="text/css" />
<link href="/web/mall/NewIndex/iconfont.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).ready(function () {
        var n = 0;
        $('#banner img').hide().eq(0).show();
        function now() {
            n++;
            if (n > $('#banner img').length - 1) { n = 0 };
            $('#banner img').fadeOut('fast').eq(n).fadeIn('fast');
            $('#banner font').removeClass().eq(n).addClass('se');
        }
        var timer = setInterval(now, 2000);
        $('#banner').hover(function () {
            clearInterval(timer);
        }, function () {
            timer = setInterval(now, 2000);
        });
        $('#banner font').mouseover(function () {
            $('#banner font').removeClass();
            $(this).addClass('se');
            var m = $(this).index();
            $('#banner img').fadeOut('fast').eq(m).fadeIn('fast');
        });
        $('.ad-seats-right > ul > li').hover(function () {
            $($(this).parent().find("li")).removeClass("none").eq($(this).index()).addClass("none");
            var n = $(this).index();
            $($(this).parent().parent().find("div")).hide().eq(n).show();
        }, function () {

        });
    });
</script>

@endsection
@section('content')
<div class="index-content-wrap">
    <div class="headtop">
        <div class="headtopleft">
            <div class="headtoplefts">
                <p> 产品分类</p>
            </div>
            <div class="headtopleftx">
                <ul>
                    @forelse(\Pcommon::indexLeftCategory(17) as $k=>$v)
                    @if($k<8)
                    <li>
                        <a href="/mall/{{$v->typedir}}"  >
                            <i class="iconfont"> &#xe728; </i>{{$v->typename}} </a>
                    </li>
                    @endif
             @empty
            @endforelse 
                  
            
                </ul>
            </div>
        </div>
        <div class="headtopright">
            <div class="headtoprights">

                <div id="banner">
                                    <a href="/">
                        <img src="/web/mall/images/01.jpg" alt="" style="display: block;" width="864" height="320">
                    </a>
                                    <a href="">
                        <img src="/web/mall/images/02.jpg" alt="" style="display: none;" width="864" height="320">
                    </a>
                                    <p>
                                            <font class="se" style="margin-left: 5px;"></font>
                                            <font class=""></font>
                                        </p>
                </div>
               <div class="lunboright">
                    <a href="/" >
                        <img src="/web/mall/images/03.jpg"  width="162px" height="234px"> </a>
                </div>
                 <div class="lunboright">
                    <a href="/" >
                        <img src="/web/mall/images/04.jpg"  width="162px" height="234px"> </a>
                </div>
                 <div class="lunboright">
                    <a href="/" >
                        <img src="/web/mall/images/05.jpg"  width="162px" height="234px"> </a>
                </div>

            </div>
          <div class="headtoprightx">
                <ul>
                                    <li>
                        <a href="/" >
                            <img src="/web/mall/images/06.jpg" alt=""> </a>
                    </li>
                                    <li>
                        <a href="/" >
                            <img src="/web/mall/images/06.jpg" alt=""> </a>
                    </li>
                                    <li>
                        <a href="/" >
                            <img src="/web/mall/images/06.jpg" alt=""> </a>
                    </li>
                                </ul>
            </div>
        </div>
    </div>

    <div class="center">
        <!--1F start-->
@forelse(\Pcommon::indexLeftCategory(17) as $k=>$v)
        <div class="louceng">
            <div class="title-div">
                <div class="title-left">
                    <span>{{$k+1}}F</span>
                    <h2>
                        <a href="/mall/{{$v->typedir}}" >{{$v->typename}}</a>
                    </h2>
                </div>
                <div class="title-right">
                    <a href="/mall/{{$v->typedir}}" rel="nofollow"  >进入</a>
                </div>
            </div>
            <div class="ad-seats">
                <div class="ad-seats-left">
                    <a href="/mall" >
                        <img src="/web/mall/images/l1.jpg" /> 
                    </a>
                </div>
                <div class="ad-seats-right">
                    <ul>
                        <li class="none">最新产品</li>
                        <li>人气产品</li>
                        <li style="margin-left: -1px;">强势推荐</li>
                    </ul>
                    <div class="cp">
                    @forelse(\Pcommon::malls(1,$v->id) as $v2)
                        <dl>
                            <dt>
                                <a href="{{\Pcommon::murl($v2->id)}}">
                                    <img src="{{config('app.upload')}}{{$v2->litpic}}" alt="{{$v2->title}}" />
                                </a>
                            </dt>
                            <dd>
                                <a href="{{\Pcommon::murl($v2->id)}}" title="{{$v2->title}}">
                                    <p title="{{$v->title}}"> {{$v2->title}}</p>
                                </a>
                                <a href="{{\Pcommon::murl($v2->id)}}" >
                                    <p class="jiu"> {{$v2->brand}}
                                    </p>
                                </a>
                                <a class="ck" href="{{\Pcommon::murl($v2->id)}}"  title="查看产品">查看产品</a>
                                <a class="rig" href="{{\Pcommon::murl($v2->id)}}"  title="我要代理">我要代理</a>
                            </dd>
                        </dl>
                    @empty
                    @endforelse
                    </div>
                    <div class="cp" style="display: none;">
                        @forelse(\Pcommon::malls(2,$v->id) as $v2)
                        <dl>
                            <dt>
                                <a href="{{\Pcommon::murl($v2->id)}}">
                                    <img src="{{config('app.upload')}}{{$v2->litpic}}" alt="{{$v2->title}}" />
                                </a>
                            </dt>
                            <dd>
                                <a href="{{\Pcommon::murl($v2->id)}}" title="{{$v2->title}}">
                                    <p title="{{$v->title}}"> {{$v2->title}}</p>
                                </a>
                                <a href="{{\Pcommon::murl($v2->id)}}" >
                                    <p class="jiu"> {{$v2->brand}}
                                    </p>
                                </a>
                                <a class="ck" href="{{\Pcommon::murl($v2->id)}}"  title="查看产品">查看产品</a>
                                <a class="rig" href="{{\Pcommon::murl($v2->id)}}"  title="我要代理">我要代理</a>
                            </dd>
                        </dl>
                    @empty
                    @endforelse
                    </div>
                    <div class="cp" style="display: none;">
                         @forelse(\Pcommon::malls(3,$v->id) as $v2)
                        <dl>
                            <dt>
                                <a href="{{\Pcommon::murl($v2->id)}}">
                                    <img src="{{config('app.upload')}}{{$v2->litpic}}" alt="{{$v2->title}}" />
                                </a>
                            </dt>
                            <dd>
                                <a href="{{\Pcommon::murl($v2->id)}}" title="{{$v2->title}}">
                                    <p title="{{$v->title}}"> {{$v2->title}}</p>
                                </a>
                                <a href="{{\Pcommon::murl($v2->id)}}" >
                                    <p class="jiu"> {{$v2->brand}}
                                    </p>
                                </a>
                                <a class="ck" href="{{\Pcommon::murl($v2->id)}}"  title="查看产品">查看产品</a>
                                <a class="rig" href="{{\Pcommon::murl($v2->id)}}"  title="我要代理">我要代理</a>
                            </dd>
                        </dl>
                    @empty
                    @endforelse
                    </div>
                </div>
            </div>
            <div class="clearfloat"> </div>
        </div>
 @empty
@endforelse 


    </div>
</div>
@endsection