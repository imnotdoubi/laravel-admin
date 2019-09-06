@extends('web.know.head') 

@section('content')

<div class="ask_main">

    <div class="amLeft" id="floatLeft">
        <h2>全部分类</h2>
        <ul>
            @forelse(\Pcommon::indexLeftCategory(16) as $k=>$v)
            <li><a href="/know/{{$v->typedir}}">{{$v->typename}}</a></li>
             @empty
            @endforelse  
        </ul>
    </div>
    
    <div class="amIn">
        <!---itemlist S--->
        @forelse($list as $v)

             <div class="AskItemList">
                <div class="top">
                    <div class="info">
                        <span style="color:#666;">提问时间：</span><span>{{$v->created_at}}</span>
                        <a href="{{\Pcommon::aurl($v->id)}}" class="title">{{$v->title}}</a>
                    </div>
                    <div class="da">
                        <span><em>{{$v->qcount($v->id)}}</em><dl>已有回答</dl></span>
                    </div>
                </div>
                <div class="desc">{!! $v->content !!}</div>
                <div class="tags">
               
                    <div class="share_bar_con">
                        <span>
                            <dl>浏览量</dl><em>({{$v->hits}})</em><i>|</i>
                        </span>
                    </div>
                </div>
            </div>
                    @empty
                    @endforelse
     

        <!---itemlist E--->
       
        <div class="page_fenye"> 
                       {!! $links !!}
                </div>
    </div>


@include('web.know.foot')
</div>
@endsection