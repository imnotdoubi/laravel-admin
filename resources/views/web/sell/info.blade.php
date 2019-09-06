@extends('web.layouts.mall_main') 
@section('title')
供应
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
                    &gt;<a href="/sell">供应</a>
                </li>

                <li>
                    &gt;{{$sell->name}}</li>
            </ul>
        </div>
    </div>
    <div class="center">
        <div class="centerleft">
            <div class="centerlefttop">

                <div class="cpdatu">
                    <div class="cplogo">

                            @if(!empty($sell->thumb))
                                @forelse($sell->thumb as $k=>$v)
                                @if($k==0)
                                         <a href="javascript:void(0);"><img src="{{config('app.upload')}}{{$v}}" style="width: 293px;"/></a>
                                        @endif
                                    @empty
                                    @endforelse
                            @else
                               <a href="javascript:void(0);"> <img src="{{config('app.upload')}}{{$sell->litpic}}" alt="{{$sell->title}}" style="width: 293px;" /></a>                          
                            @endif
                    </div>
                    <div class="cplogoxia">
                        <ul>
                           
                                @if(!empty($sell->thumb))
                                    @forelse($sell->thumb as $k=>$v)
                    <span> <a href="javascript:void(0);"><img src="{{config('app.upload')}}{{$v}}" style="height: 68px; width: 68px;"/></a></span>
                                    @empty
                                    @endforelse
                            @else
                             <span>
                                <a href="javascript:void(0);">
                                    <img src="{{config('app.upload')}}{{$sell->litpic}}" alt="{{$sell->title}}" style="height: 68px; width: 68px;" />
                                </a></span>
                                @endif
                            
                        </ul>
                    </div>
                </div>
                <div class="cplogoright">
                    <div class="cplogorights">
                        <div>
                            <h1 style="font-size: 20px; font-weight: bold;">
                                {{$sell->title}}</h1>
                        </div>
                        <p>产品价格：{{$sell->price}}&nbsp;&nbsp;/&nbsp;&nbsp;产品人气：{{$sell->hits}}人</p>
                        <p>电话：{{$sell->telephone}}</p>

                        <p>供货总量：{{$sell->amount}}</p>
                        <p>最小起订量：{{$sell->minamount}}</p>
                        <p>发布时间：{{date('Y-m-d',strtotime($sell->created_at))}}</p>
                        <a href="#">
                            <span>我要供应</span>
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
                    {!! str_replace('src="/upload','src="http://47.98.200.91/upload',$sell->content) !!}
                </div>
            </div>
        </div>
        <div class="centerright">
            <div class="gsxx">

                <div class="gsxxs">
                    <h2>
                        <a   style="width: 100%;
                                            height: 100%; color: #fff; text-align: center; display: inline-block; line-height: 37px;">
                            {{$sell->title}}</a>
                    </h2>
                </div>
                <div class="gsxxx">
                    <ul>
                        <li>地址：{{$sell->address}}</li>
                        <li>地区：{{$sell->provs->title}}</li>
                        <li>公司：{{$sell->company}}</li>
                        <li>QQ：{{$sell->qq}}</li>
                        <li>微信：{{$sell->wx}}</li>
                        <li>产品名：{{$sell->brand}}</li>
                    </ul>
                </div>

                <div class="zxcp">
                    <div class="zxcps">
                        <strong>
                            <span></span>相关产品</strong>
                    </div>
                    <div class="zxcpx">
                        <ul>

                             @forelse(\Pcommon::sells($sell->parent_id) as $v)
                            <li>
                                <a href="{{\Pcommon::surl($v->id)}}" >
                                    <img src="{{config('app.upload')}}{{$v->litpic}}" alt="{{$v->title}}" style="width: 123px; height: 149px;" />
                                </a>
                                <dl>
                                    <dt>
                                        <a href="{{\Pcommon::surl($v->id)}}" >
                                            {{str_limit($v->title,18)}}</a>
                                        <dd>
                                            <a href="{{\Pcommon::surl($v->id)}}" rel="nofollow"  style="font-size: 12px;">{!! str_limit(strip_tags($v->introduce),80) !!}</a>
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