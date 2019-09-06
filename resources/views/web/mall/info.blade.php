@extends('web.layouts.mall_main') 
@section('title')
商城
@endsection
@section('res')
<link rel="stylesheet" href="/web/mall/NewIndex/css/reset.css" type="text/css" />
<link rel="stylesheet" href="/web/mall/NewIndex/css/common.css" type="text/css" />
<link rel="stylesheet" href="/web/mall/NewIndex/css/flash.css" type="text/css" />
<link rel="stylesheet" href="/web/mall/NewIndex/css/companied.css" type="text/css" />
<link href="/web/mall/NewIndex/css/product_Details.css" rel="stylesheet" type="text/css" />
<script src="/web/mall/js/product_Detials.js" type="text/javascript"></script>
@endsection @section('content')
<div class="index-content-wrap">
    <div class="mianbao">
        <div class="mianbaol">
        </div>
        <div class="mianbaor">
            <ul>
                <li>
                    <a href="/" >首页</a>
                </li>
                <li>
                    &gt;<a href="/mall">商城</a>
                </li>

                <li>
                    &gt;{{$mall->name}}</li>
            </ul>
        </div>
    </div>
    <div class="center">
        <div class="centerleft">
            <div class="centerlefttop">

                <div class="cpdatu">
                    <div class="cplogo">

                            @if(!empty($mall->thumb))
                                @forelse($mall->thumb as $k=>$v)
                                @if($k==0)
                                         <a href="javascript:void(0);"><img src="{{config('app.upload')}}{{$v}}" style="width: 293px;"/></a>
                                        @endif
                                    @empty
                                    @endforelse
                            @else
                               <a href="javascript:void(0);"> <img src="{{config('app.upload')}}{{$mall->litpic}}" alt="{{$mall->title}}" style="width: 293px;" /></a>                          
                            @endif
                    </div>
                    <div class="cplogoxia">
                        <ul>
                           
                                @if(!empty($mall->thumb))
                                    @forelse($mall->thumb as $k=>$v)
                    <span> <a href="javascript:void(0);"><img src="{{config('app.upload')}}{{$v}}" style="height: 68px; width: 68px;"/></a></span>
                                    @empty
                                    @endforelse
                            @else
                             <span>
                                <a href="javascript:void(0);">
                                    <img src="{{config('app.upload')}}{{$mall->litpic}}" alt="{{$mall->title}}" style="height: 68px; width: 68px;" />
                                </a></span>
                                @endif
                            
                        </ul>
                    </div>
                </div>
                <div class="cplogoright">
                    <div class="cplogorights">
                        <div>
                            <h1 style="font-size: 20px; font-weight: bold;">
                                {{$mall->title}}</h1>
                        </div>
                        <p>
                            产品价格：{{$mall->price}}</p>
                        <p>
                            招商区域：全国</p>
                        <p>
                            产品人气：{{$mall->hits}}人</p>
                        <p>
                            发布时间：{{date('Y-m-d',strtotime($mall->created_at))}}</p>
                        <a href="#">
                            <span>我要代理</span>
                        </a>
                    </div>
          
                </div>
                <div class="cpjs">
                    <div class="cpjss">
                        <span>
                            <a href="javascript:void(0);">
                                <h2>
                                    产品介绍</h2>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="tuwen">
                    <!--在你自己的服务器请去掉替换-->
                    {!! str_replace('src="/upload','src="http://47.98.200.91/upload',$mall->content) !!}
                </div>
            </div>
        </div>
        <div class="centerright">
            <div class="gsxx">

                <div class="gsxxs">
                    <h2>
                        <a   style="width: 100%;
                                            height: 100%; color: #fff; text-align: center; display: inline-block; line-height: 37px;">
                            {{$mall->title}}</a>
                    </h2>
                </div>
                <div class="gsxxx">
                    <ul>
                        <li>库存：{{$mall->amount}}</li>
                        <li>地区：{{$mall->provs->title}}</li>
                        <li>{{$mall->n1}}</li>
                        <li>产品名：{{$mall->brand}}</li>
                    </ul>
                </div>

                <div class="zxcp">
                    <div class="zxcps">
                        <strong>
                            <span></span>相关产品</strong>
                    </div>
                    <div class="zxcpx">
                        <ul>

                             @forelse(\Pcommon::malls(2,$mall->parent_id) as $v)
                            <li>
                                <a href="{{\Pcommon::murl($v->id)}}" >
                                    <img src="{{config('app.upload')}}{{$v->litpic}}" alt="{{$v->title}}" style="width: 123px; height: 149px;" />
                                </a>
                                <dl>
                                    <dt>
                                        <a href="{{\Pcommon::murl($v->id)}}" >
                                            {{str_limit($v->title,18)}}</a>
                                        <dd>
                                            <a href="{{\Pcommon::murl($v->id)}}" rel="nofollow"  style="font-size: 12px;">{!! str_limit(strip_tags($v->introduce),80) !!}</a>
                                        </dd>
                                    </dt>
                                </dl>
                            </li>
                            @empty @endforelse
                        </ul>
                    </div>
                </div>
         
          
            </div>
        </div>
        <div class="clearfloat">
        </div>
    </div>
</div>

@endsection