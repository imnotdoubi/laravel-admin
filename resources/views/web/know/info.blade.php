@extends('web.know.head') 

@section('content')

<div class="ask_main">


     <div class="amVist" style="">
    
        <div class="curNav">
            <a href="/">网站首页</a><span>&gt;<a href="/know">问答</a></span>
        </div>
        
        <!-----详情信息 S-------->
        <div class="vistInfo" style="">
            <h1>@if($head->quesid)<span>[已采纳]&nbsp;</span>@endif{{$head->title}}</h1>
            
            <div class="fui">
                <div class="time">{{$head->created_at}} <span>提问</span></div>
            </div>
            
            <div class="content">
                {!! $head->content !!}

            </div>
            
            <div class="vice-info">
                <a class="MydaBut" id="MydaBut"><i>答</i><span>我来答</span></a>
               {{--  <div class="th">
                    <a href="/" class="z"><span>反对</span><em>2</em></a><i>|</i>
                    <a href="/" class="z"><span>支持</span><em>1</em></a><i>|</i>

                </div> --}}
                <div class="hits">浏览 {{$head->hits}} 次</div>
            </div>
            
        
            
            <div class="AnswerQuantity">
            <span>已有<em>{{$head->qcount($head->id)}}</em>个回答</span>
            </div>

            <!---AnswerItemList S--->
            @forelse($qsk as $k=>$v)
         
            <div class="AnswerItemList">
                <div class="userInfo">

                    <div class="info">
                        <span><dl>@if($head->quesid==$v->id)<font style="color: red;">[已采纳]</font>&nbsp;@endif 回答时间：</dl><em>{{$v->created_at}}</em></span>
                    </div>
                </div>
                <div class="content" id="wrap1">
                {!! $v->content !!}

                </div>
                <div class="read-more" id="read-more1"></div>
                <div class="fuInfo">
                    <div class="Fabulous"><span>点赞</span><em>{{$v->zhichi}}</em></div>
                    <a  class="Report">反对<em>{{$v->fandui}}</em></a>
                </div>
            </div>
             @empty
            @endforelse 

            <!---AnswerItemList E--->
        
        </div>
        <!-----详情信息 E-------->

    </div>


@include('web.know.foot')
</div>
@endsection