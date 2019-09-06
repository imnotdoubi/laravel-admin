@extends('web.layouts.main') 
@section('res')
<link href="/web/css/list.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div style="background-color:#f7f7f7; padding-bottom:20px;">

<div class="weizhi box">
	<a href="/">首页</a>&gt;<a href="/xm">加盟项目</a>&gt;
</div>

<div class="brand_tit clearfix">
    <div class="brand_tit_pic"><img src="/web/images/yongtu/a9.jpg" /></div>
    <div class="brand_tit_jj">
        <h1>{{$head->combrand}}</h1>
        <p>{{$head->comname}}</p>
        
    </div>
    <div class="brand_tit_r">
		<span class="pic1">注册资金<br />{{$head->capital}}万</span>
		<span class="pic2">总部地址<br />{{\Pcommon::getArea($head->province,'title')}}/{{\Pcommon::getArea($head->city,'title')}}</span>
		<span class="pic3">加盟店<br />{{$head->mdnum}}家</span>
		<div class="cx"><i>诚信登记</i><p>5颗星</p></div>
		<a href="#" class="go_ly">申请加盟</a>
	</div>
    
</div>


<div class="box clearfix" style="background-color:#fff; margin-top:20px; padding-bottom:20px;">

<div class="brand_pic">
<div id="slider" class="flexslider4" >
	<ul class="slides">
		@if(!empty($head->imagesarr))
			@forelse($head->imagesarr as $k=>$v)
                	<li><img src="{{config('app.upload')}}{{$v}}" /></li>
				@empty
				@endforelse
		@endif
	</ul>
</div>
					
<div id="carousel" class="carousel" style="width:400px;">
	<ul class="slides">
		@if(!empty($head->imagesarr))
			@forelse($head->imagesarr as $k=>$v)
                	<li><img src="{{config('app.upload')}}{{$v}}" /></li>
				@empty
				@endforelse
		@endif		
	</ul>
</div>
</div>

<div class="brand_xq">
	<strong>{{$head->combrand}}加盟</strong>
	
    <div class="brand_xq_js1" >{{$head->introduce}}</div>
	<ul class="clearfix">
		<li>分类：{{\Pcommon::categorys($head->parent_id,'typename')}}<i></i></li>
		<li>注册年份：<i>{{$head->regyear}}</i></li>
		<li>经营模式：<i>{{$head->mode}}</i></li>
		<li>适合人群：<i>{{$head->renqun}}</i></li>
		<li>意向加盟：<i>{{$head->yxnum}}人</i></li>
		<li>申请加盟：<i>{{$head->sqnum}}人</i></li>
	</ul>
   	<div class="clerafix zbtg"><i>总部培训</i><i>营销推广培训</i><i>平台支持</i><i>运营支持</i></div>
	 <div  class="brand_xq_js2" >投资金额：<i>{{\Pcommon::indexTzid($head->size)}}</i>(不包含商铺租金、装修等费用)</div>
	
	<div class="brand_xq_btn">
		<a  href="#liuyan" class="btn1">在线申请加盟<i>1</i></a>
		<a  href="#liuyan" class="btn2">免费获取资料</a>
	</div>
</div>

</div>

<div class="box clearfix">
	<div class="w900">
    	<div class="xm_wz">
		<div class="qiye_tit"><a href="#">我要加盟</a>{{$head->combrand}}项目介绍</div>
		<div class="content">
          <div class="layout-info-l">
	<div class="item-article" id="jmxq">
		<div class="con">
			<!--在你自己的服务器请去掉替换-->
			{!! str_replace('src="/upload','src="http://47.98.200.91/upload',$head->companydata->content) !!}

		</div>

	</div>

	</div>
        </div>
        </div>
        
        
        <div class="brand_news">
        	<div class="qiye_tit"><a href="#liuyan">我要加盟</a>{{$head->combrand}}资讯</div>
            <ul class="clearfix">
            	@forelse($xmnews as $v)
            		<li><a href="{{\Pcommon::cnurl($head->purl,$v->id)}}">{{$v->title}}</a></li>
            	@empty
				@endforelse

            </ul>
        </div>

  	@include('web.article.message')

	</div>
	
	<style type="text/css">
	.project_ph,.project2,.news1,.biaoqian{ background-color:#fff; border:none; margin-top:20px;}
	</style>

		@include('web.article.right')
	
	
</div>


	
</div>


@endsection