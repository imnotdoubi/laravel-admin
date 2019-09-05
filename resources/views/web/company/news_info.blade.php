@extends('web.layouts.main')
@section('res')
<link href="/web/css/list.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div style="background-color:#f7f7f7; padding-bottom:20px;">

    <div class="weizhi box">
        <a href="/">首页</a>&gt;<a href="/xm">项目</a>&gt;{{$company->combrand}}
    </div>

    <style type="text/css">
        .project_ph{ margin-top:0;}
    </style>

    <div class="box clearfix">
        <div class="w900">
            <div class="news_cn">
            <h1>{{$head->title}}</h1>
            <div class="news_cn_time">更新时间：{{$head->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;来源：云海天&nbsp;&nbsp;&nbsp;&nbsp;阅读：{{$head->hits}}次</div>
             <div class="news_barnd clearfix">
            <div class="news_brand_pic"><a href="{{\Pcommon::curl($company->id)}}"><img src="{{config('app.upload')}}{{$company->thumb}}" /></a></div>
            <div class="news_brand_js">
                <strong><a href="{{\Pcommon::curl($company->id)}}">{{$company->combrand}}</a></strong>
                <p>所属行业：{{$company->comname}}</p>
                <p>门店数量：{{$company->mdnum}}家</p>
                <p>投资金额：{{\Pcommon::indexTzid($company->size)}}</p>
            </div>
            <div class="news_brand_btn">
                <a href="#">查看详情</a>
                <a href="#liuyan" class="btn">索取资料</a>
            </div>
            
        </div>
            <div class="content">
                {!! $head->content !!}
            </div>
            
            <div class="page_sx clearfix">
                <span class="page_sx_pre">
                    @if($pre_news)
                        <a href="{{\Pcommon::cnurl($company->purl,$pre_news->id)}}"><i>{{$pre_news->title}}</i></a>
                        @else
                        没有了
                        @endif
                    </span>
                <span class="page_sx_next">
                    @if($next_news)
                        <a href="{{\Pcommon::cnurl($company->purl,$next_news->id)}}"><i>{{$next_news->title}}</i></a>
                        @else
                        没有了
                    @endif</span>
            </div>
            </div>
            
            
            @include('web.article.message')
          
        
        </div>

        @include('web.article.right')

    </div>
    
</div>



@endsection