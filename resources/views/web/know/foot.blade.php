
          
              <div class="amRight">
        <a href="/ask/questions.html" class="askBut">我有问题，我要提问！</a>
     
        
        <h2>最新提问</h2>
        <div class="newAnswer">
            <!---item S--->
                @forelse(\Pcommon::rightasks() as $v)
                <div class="item"><a href="{{\Pcommon::aurl($v->id)}}" class="t">{{$v->title}}</a></div>
                @empty
                @endforelse
            <!---item E--->
        </div>
        
       <div style="width:100%; height:20px;"> </div>
       
           <div class="floatRight" id="floatLeft2">
        
        <div class="footer">
            <h2><span>联系我们</span></h2>
            <div class="qq">
                <span>客服：云海天</span>
                <span>联系：https://github.com/imnotdoubi</span>
            </div>
            <div class="copyright">
                <p>版权所有：云海天</p>
            </div>

       </div>

    </div>
       

 </div>