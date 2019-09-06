<div class="mianbao">
        <div class="mianbaol"> </div>
        <div class="mianbaor">
            <ul>
                <a href="/">
                    <li>首页</li>
                </a>
                
                <a href="/mall">
                    <li>
                        &gt;商城
                    </li>
                </a>

            </ul>
        </div>
    </div>
    <!--分类导航-->
    <div class="fenlei">
        <p> 分类>></p>
        <ul>
            
         @forelse(\Pcommon::indexLeftCategory(17) as $k=>$v)
            <li @if(empty($pcate))@if($category->id == $v->id) class='selector-active' @endif @else @if($pcate->id == $v->id) class='selector-active' @endif @endif>
                <a href="/mall/{{$v->typedir}}" title="{{$v->typename}}"> {{$v->typename}}</a>
            </li>
        @empty
        @endforelse
        </ul>
    </div>
    <div class="fenlei">
        <p> 子分类>></p>
        <ul>
            @php
                if(empty($pcate)){
                    $cChild = $category->id;
                    $cparid = $category->parent_id;
                }
                else{
                    $cChild = $pcate->id;
                    $cparid = $category->id;
                }

            @endphp
         @forelse(\Pcommon::indexLeftCategory($cChild) as $k=>$v)
            <li @if($cparid == $v->id) class='selector-active' @endif>
                <a href="/mall/{{$v->typedir}}" title="{{$v->typename}}"> {{$v->typename}}</a>
            </li>
        @empty
        @endforelse
        </ul>
    </div>
    <!--地区导航-->
    <div class="daohang">
        <a class="showArea" href="javascript:void(0);">
            <p> @if(isset($area)) {{$area->title}} @else 所在地区 @endif
                <img src="/web/mall/images/top-xiala.png">
            </p>
        </a>
        <div class="daohangr">
            <img src="/web/mall/images/qiehuan1.png">
            <a href="/mall/l_{{$category->typedir}}">列表</a>
        </div>
        <div class="daohangr">
            <img src="/web/mall/images/qiehuan2.png">
            <a href="/mall/{{$category->typedir}}">大图</a>
        </div>
        <div class="hideItem">
            <ul class="ulItem areaItem">
                <li @if(!isset($area)) class='selector-active' @endif>
                    <a href="/mall/{{$ftype}}{{$category->typedir}}"> 全部</a>
                </li>
                @forelse(\Pcommon::areas() as $v)
                <li @if(isset($area) && $area->id == $v->id) class='selector-active' @endif>
                    <a href="/mall/{{$ftype}}{{$category->typedir}}/{{$v->name}}"> {{$v->title}}</a>
                </li>
                @empty
                @endforelse
            </ul>
        </div>
    </div>