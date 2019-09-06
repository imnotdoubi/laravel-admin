<div class="centerright">

            <div class="centerrights">
                <div class="biaoti">
                    <span></span>
                    <h2> 推荐产品</h2>
                </div>
                 @forelse(\Pcommon::malls(4,0) as $v)
                        <div class="tjcp">
                            <a href="{{\Pcommon::murl($v->id)}}">
                                <img src="{{config('app.upload')}}{{$v->litpic}}" style="width: 181px; height: 200px;"
                                />
                            </a>
                            <p>{{$v->title}}</p>
                        </div>
                    @empty
                    @endforelse

            </div>

        </div>