@extends('web.member.layouts.main')
@section('content')
<link rel="stylesheet" href="/web/member/user.css" />
	<div class="content_right_top clearfix">
		<h2 class="left"> 供应信息管理</h2>
	</div>
	<div class=" clearfix person_com product_check">
		<div class="clearfix tab">
			<ul class="left">
				<li>
					<h2 @if($status == 2) class="selected" @endif> <a href="/member/sell">全部</a></h2>
				</li>
				<li>
					<h2 @if($status == 1) class="selected" @endif> <a href="/member/sell/1">审核通过</a></h2>
				</li>
				<li>
					<h2 @if($status == 0) class="selected" @endif> <a href="/member/sell/0">审核中</a></h2>
				</li>
			</ul>
			<a href="/member/sell/create" class="add_cert left addlink">添加供应信息</a> </div>

		<div class="check_result">
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr style="border-bottom: 1px solid #cfcfcf;">
						<th width="54" height="41"> <input type="checkbox" id="select_all" onclick="select_all()"/>
							<label for="select_all"> </label>
						</th>
				
						<th width="206"> 供应名称 </th>
						<th width="150"> 系列 </th>
						<th width="140"> 发布时间 </th>
						<th width="80"> 状态 </th>
						<th style="border-right: none;" width="100"> 操作 </th>
					</tr>
				</thead>
				<tbody>
				@forelse($list as $v)
					<tr>
						<td align="center">{{$v->id}}</td>
						
						<td title="{{$v->title}}"> {{$v->title}} </td>
						<td>{{$v->typeids($v->typeid)}} </td>
		
						<td align="center"> {{$v->created_at}} </td>
						<td align="center" title="审核通过">
							@if($v->status == 0)
							<img style="width:16px;height:16px;border:none;" src="/web/member/images/no.png" />
                            @else
                            <img  style="width:16px;height:16px;border:none;" src="/web/member/images/yes.png" />
                            @endif
						</td>
						<td align="center">
							<a href="/member/sell/{{$v->id}}/edit"><img src="/web/member/images/edit.gif" /></a>
						</td>
					</tr>
				@empty
				@endforelse
				</tbody>
			</table>
		</div>
		<!-- 分页 -->
		<div class="page" style="margin: 12px auto; _margin: 11px auto;"> 
			<div id="AspNetPager1">
				<div style="width:40%;float:left;"> 【共{{$list->total()}}条记录】</div>
				<div style="width:60%;float:left;"> 
					{!! $list->links() !!}
				</div>
			</div>
			
		</div>
	</div>

<script type="text/javascript">

    $("#select_all").click(function() {
        $(".check_result tr:gt(0) input:checkbox").attr("checked", $(this).attr("checked"));
    });
   
</script>
@endsection