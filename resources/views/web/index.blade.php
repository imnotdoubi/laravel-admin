@extends('web.layouts.main') @section('content')

<div class="bs_fg">
<div class="box clearfix">
    <div class="nav">
	        <div class="clearfix">
	        	 @forelse(\Pcommon::indexLeftCategory(4) as $k=>$v)
	        <a href="/{{$v->typedir}}">{{$v->typename}}</a>
			        @empty
		        @endforelse
                <!--因数据有限，调用其他分类下数据，如果你的数据够，请删除下面的调用-->
                 @forelse(\Pcommon::indexLeftCategory(17) as $k=>$v)
            <a href="/mall/{{$v->typedir}}">{{$v->typename}}</a>
                    @empty
                @endforelse
                 @forelse(\Pcommon::indexLeftCategory(15) as $k=>$v)
            <a href="/news/{{$v->typedir}}">{{$v->typename}}</a>
                    @empty
                @endforelse

                 @forelse(\Pcommon::indexLeftCategory(18) as $k=>$v)
            <a href="/sell/{{$v->typedir}}">{{$v->typename}}</a>
                    @empty
                @endforelse 
                @forelse(\Pcommon::indexLeftCategory(19) as $k=>$v)
            <a href="/photo/{{$v->typedir}}">{{$v->typename}}</a>
                    @empty
                @endforelse       
	    	 </div>
    </div>
    
    <div class="zt_center">
        <div class="flexslider">
            <ul class="slides">
                <li><a href="https://github.com/imnotdoubi/laravel-admin" ><img src="/web/images/flash2/1.jpg" /></a></li>
                <li><a href="https://github.com/imnotdoubi/laravel-admin" ><img src="/web/images/flash2/2.jpg" /></a></li>
                <li><a href="https://github.com/imnotdoubi/laravel-admin" ><img src="/web/images/flash2/3.jpg" /></a></li>
                <li><a href="https://github.com/imnotdoubi/laravel-admin" ><img src="/web/images/flash2/4.jpg" /></a></li>
            </ul>
        </div>
        <!-- 幻灯片 End -->
        <div class="in_tjpic">
        <a href="javascript:void(0)" class="anli_pre" title="上一组图片"></a>
    <a href="javascript:void(0)" class="anli_next" title="上一组图片"></a>
        <div class="anli_marquee">
        
        <ul class="anli_marqueea clearfix">
        	 @forelse(\Pcommon::indexCompanys() as $v)
		        <li><a href="{{\Pcommon::curl($v->id)}}"><img src="{{config('app.upload')}}{{$v->thumb}}" alt="{{$v->combrand}}" width="228" height="118"/></a></li>
	        @empty
	        @endforelse
        </ul>
        </div>
        </div>
    </div>
    
    <div class="ranking">
        <div class="title"><strong>项目关注排行榜</strong><span>ranking list</span></div>
        <ul>
        	 @forelse(\Pcommon::indexHotCompanys() as $v)
	        	<li><span>{{$v->hits}}</span><a href="{{\Pcommon::curl($v->id)}}">{{$v->combrand}}</a></li>
	        @empty
	        @endforelse
        </ul>
    </div>
</div>
<div class="bn box" style="padding-bottom:8px;"><img src="/web/images/yongtu/gg1.jpg" width="1180" height="80" /></div>
</div>

 @forelse(\Pcommon::indexLeftCategory(4) as $k=>$v)
	 @if($k < 3)
		<div class="box clearfix">
		    <div class="jingxuan_title"><strong>{{$v->typename}}品牌推荐</strong><span>
		    	 @forelse(\Pcommon::indexLeftCategory($v->id) as $k2=>$v2)
		        <a href="/{{$v2->typedir}}">{{$v2->typename}}</a>
		         @empty
				@endforelse
		    <a href="/{{$v->typedir}}" class="more">更多 &gt;</a>
		    </span></div>
		    
		    <div class="xm_list2">
		        <ul class="clearfix">
		        @forelse(\Pcommon::indexTjCompanys($v->id) as $k3=>$v3)
		         <li><a href="{{\Pcommon::curl($v3->id)}}"><img src="{{config('app.upload')}}{{$v3->thumb}}" /><div><span>{{$v3->combrand}}</span><p><i>门店：{{$v3->mdnum}}家</i>{{\Pcommon::indexTzid($v3->size)}}</p></div></a></li>
		         @empty
				@endforelse
		        </ul>
		    </div>
		</div>
	@endif
    @empty
@endforelse

<div class="box clearfix">
    <div class="bn_left">
    <div class="title1"><strong>今日推荐</strong></div>
    <div class="flexslider2">
            
            <ul class="slides">
                @forelse(\Pcommon::indexRqCompanys() as $k=>$v)
                @if($k<5)
                <li>
                    <a href="{{\Pcommon::curl($v->id)}}" class="pic"><img src="{{config('app.upload')}}{{$v->thumb}}" /></a>
                    <div class="bt"><strong>{{$v->comname}}</strong><i>{{\Pcommon::indexTzid($v->tzid)}}</i></div>
                    <p>{{$v->mode}}</p>
                    <div><span><i>全国门店：</i>{{$v->mdnum}}家</span><span><i>加盟意向：</i>{{$v->yxnum}}人</span></div>
                    <div><i>经营范围：</i>{{$v->business}}<span><i>申请加盟：</i>{{$v->sqnum}}人</span></div>
                    <div><i>公司地址：</i>{{$v->address}}</div>
                </li>
                @endif
            @empty
				@endforelse
            </ul>
        </div>
    </div>
        
        <div class="xm_list3">
        <div class="title1"><strong>精选品牌</strong></div>
        <ul class="clearfix">
              @forelse(\Pcommon::indexRqCompanys() as $k=>$v)
               @if($k>4)
               <li><a href="{{\Pcommon::curl($v->id)}}" ><img src="{{config('app.upload')}}{{$v->thumb}}" alt="{{$v->combrand}}"/>
                <div><span>{{$v->combrand}}</span><p><i>门店：{{$v->mdnum}}家</i>{{\Pcommon::indexTzid($v->size)}}</p></div></a></li>
                @endif
             @empty
				@endforelse
        </ul>
    </div>
</div>

<div class="box clearfix">
    <div class="title1"><strong>加盟资讯</strong><span>
    </span></div>
    <div class="zx_right">
        <div class="bt2"><strong>最新资讯</strong></div>
        <ul>
        	@forelse(\Pcommon::indexNews() as $k=>$v)
                  <li>
                <span><a href="{{\Pcommon::nurl($v->id)}}"><img src="{{config('app.upload')}}{{$v->conver}}" /></a></span>
                <strong><a href="{{\Pcommon::nurl($v->id)}}">{{$v->title}}</a></strong>
                <p>{{str_limit($v->description,60,'')}}</p>
            </li>
             @empty
			@endforelse
        </ul>
    </div>
    
    <div class="zx_left">
    
    <div class="zx_lb">
        <div class="bt2"><a href="/">更多&gt;</a><strong>问答</strong></div>
        <div class="tj">
        	@forelse(\Pcommon::indexAsk() as $k=>$v)
        	@if($k == 0)
               <span><a href="{{\Pcommon::aurl($v->id)}}"><img src="{{config('app.upload')}}{{$v->thumb}}" /></a></span>
            <strong><a href="{{\Pcommon::aurl($v->id)}}">{{$v->title}}</a></strong>
            <p>{{str_limit($v->description,30,'')}}</p>
            @endif
             @empty
			@endforelse
        </div>
        <ul>
        	@forelse(\Pcommon::indexAsk() as $k=>$v)
        	@if($k > 0)
            <li><a href="{{\Pcommon::aurl($v->id)}}">{{$v->title}}</a></li>
            @endif
             @empty
			@endforelse
        </ul>
    </div>
    <div class="zx_lb">
        <div class="bt2"><a href="/">更多&gt;</a><strong>商城</strong></div>
        <div class="tj">
        	@forelse(\Pcommon::indexMall() as $k=>$v)
        	@if($k == 0)
               <span><a href="{{\Pcommon::murl($v->id)}}"><img src="{{config('app.upload')}}{{$v->litpic}}" /></a></span>
            <strong><a href="{{\Pcommon::murl($v->id)}}">{{$v->title}}</a></strong>
            <p>{{str_limit($v->description,30,'')}}</p>
            @endif
             @empty
			@endforelse
        </div>
        <ul>
        	@forelse(\Pcommon::indexMall() as $k=>$v)
        	@if($k > 0)
            <li><a href="{{\Pcommon::murl($v->id)}}">{{$v->title}}</a></li>
            @endif
             @empty
			@endforelse
        </ul>
    </div>
    
    <div class="zx_lb">
        <div class="bt2"><a href="/">更多&gt;</a><strong>供应</strong></div>
        <div class="tj">
        	@forelse(\Pcommon::indexSell() as $k=>$v)
        	@if($k == 0)
               <span><a href="{{\Pcommon::surl($v->id)}}"><img src="{{config('app.upload')}}{{$v->litpic}}" /></a></span>
            <strong><a href="{{\Pcommon::surl($v->id)}}">{{$v->title}}</a></strong>
            <p>{{str_limit($v->description,30,'')}}</p>
            @endif
             @empty
			@endforelse
        </div>
        <ul>
        	@forelse(\Pcommon::indexSell() as $k=>$v)
        	@if($k > 0)
            <li><a href="{{\Pcommon::surl($v->id)}}">{{$v->title}}</a></li>
            @endif
             @empty
			@endforelse
        </ul>
    </div>
    
    <div class="zx_lb">
        <div class="bt2"><a href="/">更多&gt;</a><strong>图库</strong></div>
        <div class="tj">
        	@forelse(\Pcommon::indexPhoto() as $k=>$v)
        	@if($k == 0)
               <span><a href="{{\Pcommon::purl($v->id)}}"><img src="{{config('app.upload')}}{{$v->thumb}}" /></a></span>
            <strong><a href="{{\Pcommon::purl($v->id)}}">{{$v->title}}</a></strong>
            <p>{{str_limit($v->description,30,'')}}</p>
            @endif
             @empty
			@endforelse
        </div>
        <ul>
        	@forelse(\Pcommon::indexPhoto() as $k=>$v)
        	@if($k > 0)
            <li><a href="{{\Pcommon::purl($v->id)}}">{{$v->title}}</a></li>
            @endif
             @empty
			@endforelse
        </ul>
    </div>
    </div>
    
</div>

@endsection