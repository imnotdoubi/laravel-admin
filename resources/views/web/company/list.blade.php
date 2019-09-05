@extends('web.layouts.main') 
@section('res')
<link href="/web/css/list.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div style="background-color:#f7f7f7; padding-bottom:20px;">

<div class="weizhi box">
	<a href="/">首页</a>&gt;找项目
</div>
<div class="box">
<div class="retrieval">
	<div class="retrieval_a clearfix">
		<span class="pic1">行业分类：</span>
		<em><a href="/xm"  @if($path == 'xm')class="dq"@endif>不限</a></em>	
		<div class="r_text">
			@forelse(\Pcommon::indexLeftCategory(4) as $k=>$v)
	        <a @if($path == $v->typedir)class="dq"@endif href="/{{$v->typedir}}">{{$v->typename}}</a>
		     @empty
	        @endforelse   	
		</div>
	</div>
	@if($path != 'xm')
		<div class="retrieval_a clearfix">
			<span class="pic1">子 分 类：</span>
			<em><a href="/xm"  @if(empty($cpath))class="dq"@endif>不限</a></em>	
			<div class="r_text">
				@forelse(\Pcommon::indexLeftCategory($cid) as $k=>$v)
		        	<a  @if($cpath == $v->typedir)class="dq"@endif  href="/{{$v->typedir}}">{{$v->typename}}</a>
			     @empty
		        @endforelse   	
			</div>
		</div>
	@endif

	<div class="retrieval_a clearfix">
		<span class="pic2">金额：</span>
		<div class="r_text">
			<a href="/xm"   @if($jine==0)class="dq"@endif>不限</a>	
 				@forelse(\Pcommon::headInvest() as $k => $v)
 					@if(empty($cpath))
                            <a @if($jine==$v->id)class="dq"@endif href="/{{$path}}/{{$v->id}}">{{$v->title}}</a>
					@else
					        <a @if($jine==$v->id)class="dq"@endif href="/{{$cpath}}/{{$v->id}}">{{$v->title}}</a>                   
                    @endif
                @empty
                @endforelse

		</dd>
	</div>
</div>
</div>

</div>

<div class="box clearfix">
	<div class="w900">
	<div class="project_list">
		<div class="project_title"><span>共<i>{{$list->total()}}</i>家加盟品牌</span><h1>加盟项目</h1></div>
		<ul>

		@forelse($list as $v)
				<li class="clearfix">
					<a href="{{\Pcommon::curl($v->id)}}" class="pic"><img src="{{config('app.upload')}}{{$v->thumb}}" /></a>
					<div class="project_js">
						<div class="project_t"><a href="{{\Pcommon::curl($v->id)}}">{{$v->combrand}}</a></div>
						<div class="company">{{$v->comname}} &nbsp;&nbsp;</div>
						<div class="company1">门店：<i>{{$v->mdnum}}</i>家 &nbsp;&nbsp;意向加盟：<i>{{$v->yxnum}}</i>人 &nbsp;&nbsp;申请加盟：<i>{{$v->sqnum}}</i>人</div>
						<p>{{$v->description}}</p>
					</div>
					<div class="project_r">
					<i>投资额</i>
					<span>{{\Pcommon::indexTzid($v->size)}}</span>
					<a href="{{\Pcommon::curl($v->id)}}#liuyan" class="btn">申请加盟</a>
					<a href="{{\Pcommon::curl($v->id)}}" class="more">查看详情&gt;&gt;</a>
					</div>
				</li>
					@empty
					@endforelse
		</ul>
    
       </div>
	 		<div class="page_fenye"> 
                 <ul class="pagination">
                    {!! $links !!}
            	</ul>
            </div>
	</div>
	@include('web.article.right')

	</div>
	

</div>

</div>

@endsection