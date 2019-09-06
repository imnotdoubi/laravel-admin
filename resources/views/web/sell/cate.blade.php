<div class="mianbao">
        <div class="mianbaol"> </div>
        <div class="mianbaor">
            <ul>
                <a href="/">
                    <li>首页</li>
                </a>
                
                <a href="/sell">
                    <li>
                        &gt;供应
                    </li>
                </a>

            </ul>
        </div>
    </div>
    <!--分类导航-->
    <div class="fenlei">
        <p> 分类>></p>
        <ul>
         @forelse(\Pcommon::indexLeftCategory(18) as $k=>$v)
            <li @if($sell->id == $v->id) class='selector-active' @endif>
                <a href="/sell/{{$v->typedir}}" title="{{$v->typename}}"> {{$v->typename}}</a>
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
                    $cChild = $sell->id;
                    $cparid = $sell->parent_id;
                }
                else{
                    $cChild = $pcate->id;
                    $cparid = $sell->id;
                }

            @endphp
         @forelse(\Pcommon::indexLeftCategory($cChild) as $k=>$v)
            <li @if($cparid == $v->id) class='selector-active' @endif>
                <a href="/sell/{{$v->typedir}}" title="{{$v->typename}}"> {{$v->typename}}</a>
            </li>
        @empty
        @endforelse
        </ul>
    </div>
    <!--地区导航-->
    <div class="fenlei" style="height: 78px;">
            <p> 所在地区 >> </p>

            <ul>
                <li @if(!isset($area)) class='selector-active' @endif>
                    <a href="/sell/{{$sell->typedir}}"> 全部</a>
                </li>
                @forelse(\Pcommon::areas() as $v)
                <li @if(isset($area) && $area->id == $v->id) class='selector-active' @endif>
                    <a href="/sell/{{$sell->typedir}}/{{$v->name}}"> {{$v->title}}</a>
                </li>
                @empty
                @endforelse
            </ul>
        </div>