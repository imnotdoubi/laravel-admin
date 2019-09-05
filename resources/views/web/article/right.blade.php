
	<div class="w260">
		<div class="project_ph">
			<div class="bt"><a href="/xm" class="more">更多&gt;&gt;</a>加盟排行</div>
			<ul>
				@forelse(\Pcommon::newCompany() as $k=>$v)
	            	<li><i>{{$k+1}}</i><a href="{{\Pcommon::curl($v->id)}}">{{$v->combrand}}</a><span>{{\Pcommon::indexTzid($v->size)}}</span></li>
	             @empty
				@endforelse
			</ul>
		</div>
		<script>
		$(function () {
			$('.project_ph ul li:eq(0)').addClass('red');
			$('.project_ph ul li:eq(1)').addClass('red');
			$('.project_ph ul li:eq(2)').addClass('red');
			$('.project2 ul li:last').addClass('qline');
		});

		</script>
		

		<div class="project2">
			<div class="bt"><a href="/xm" class="more">更多&gt;&gt;</a>加盟项目推荐</div>
			<ul>
				@forelse(\Pcommon::hotnewsCompany() as $k=>$v)
	            	<li>
						<a href="{{\Pcommon::curl($v->id)}}" class="pic"><img src="{{config('app.upload')}}{{$v->thumb}}" /></a>
						<span class="tit"><a href="{{\Pcommon::curl($v->id)}}">{{$v->combrand}}</a></span>
						<p>投资金额：{{\Pcommon::indexTzid($v->size)}}</p>
						<p>门店数：{{$v->mdnum}}家</p>
						<a href="{{\Pcommon::curl($v->id)}}" class="btn">我要加盟</a>
					</li>
	             @empty
				@endforelse

			</ul>
		</div>
		
		
		<div class="news1">
			<div class="bt"><a href="/news" class="more">更多&gt;&gt;</a>最新资讯</div>
			<ul>
				@forelse(\Pcommon::zxNews() as $k=>$v)
                	<li><a href="{{\Pcommon::nurl($v->id)}}">{{$v->title}}</a></li>
				@empty
				@endforelse
			</ul>
		</div>
		
		<div class="biaoqian">
			<div class="bt">热门搜索</div>
			<div class="biaoqian_cn clearfix">
	 		@forelse(\Pcommon::indexLeftCategory(4) as $k=>$v)
	        	<a href="/{{$v->typedir}}/">{{$v->typename}}</a>
			 @empty
		     @endforelse   	
			</div>
		</div>
	</div>