<div class="clearfix person_com add_product">
    <div class="message_edit">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                 <tr>
                    <td width="110" align="right">
                        <span class="ness">供应类型：</span>
                    </td>
                    <td class="spantip">
                    <select id="ddl_type" name="typeid">
                        <option value="1">供应</option>
                        <option value="2">提供服务</option>
                        <option value="3">供应二手</option>
                        <option value="4">提供加工</option>
                        <option value="5">提供合作</option>
                        <option value="6">库存</option>
                    </select>

                    </td>
                </tr>
                <tr>
                    <td width="110" align="right">
                        <span class="ness">信息标题</span>
                    </td>
                    <td class="spantip">
                        <input name="title" type="text" id="txtname" value="{{$title}}"  placeholder="如：云海天推广"/>
                        <span id="txtnameTip"></span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <span>商品品牌：</span>
                    </td>
                    <td>
                        <input name="brand" type="text" id="txtoname" value="{{$brand}}" placeholder="如：云海天"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <span>所属公司：</span>
                    </td>
                    <td>
                        <input name="company " type="text" value="{{$company }}" placeholder="如：云海天责任有限公司"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <span class="ness">供应分类：</span>
                    </td>
                    <td>
                        <select id="ddl_type" name="parent_id">
                          @forelse(\Pcommon::indexLeftCategory(18) as $k=>$v)
                            <option value="{{$v->id}}" @if($v->id == 1) selected @endif>{{$v->typename}}</option>
                        @empty
                        @endforelse
                        </select>
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <span>原产地：</span>
                    </td>
                    <td>
                        <select id="ddl_Area" name="areaid">
                            @forelse(\Pcommon::areas() as $v)
                            <option value="{{$v->id}}" @if($v->id == 1) selected  @endif>{{$v->title}}</option>
                            @empty
                            @endforelse
                        </select>
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <span class="ness">产品说明：</span>
                    </td>
                    <td style="text-align: left;padding-top:10px;">
                        <script id="container" name="content" type="text/plain" style="width:600px;height:280px;">{!! $content !!}</script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="/vendor/ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="/vendor/ueditor/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container');
                        </script>
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <span>最小起订量：</span>
                    </td>
                    <td>
                        <input name="minamount" type="text"  value="{{$minamount}}"  placeholder="数字：如 100"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <span>供应单价：</span>
                    </td>
                    <td>
                        <input name="price" type="text"  value="{{$price}}"  placeholder="数字：如 100"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <span>供货总量：</span>
                    </td>
                    <td>
                        <input name="amount" type="text"  value="{{$amount}}"  placeholder="数字：如 100"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <span>电话：</span>
                    </td>
                    <td>
                        <input name="telephone" type="text"  value="{{$telephone}}"  placeholder="如 13800000000"/>
                    </td>
                </tr>
                 <tr>
                    <td align="right">
                        <span>详细地址：</span>
                    </td>
                    <td>
                        <input name="address" type="text"  value="{{$address}}"  placeholder="如：北京市东城区长安街前街4号"/>
                    </td>
                </tr>
                 <tr>
                    <td align="right">
                        <span>邮箱：</span>
                    </td>
                    <td>
                        <input name="email" type="text"  value="{{$email}}"  placeholder="如：yht@qq.com"/>
                    </td>
                </tr>
                 <tr>
                    <td align="right">
                        <span>QQ：</span>
                    </td>
                    <td>
                        <input name="email" type="text"  value="{{$qq}}"  placeholder="如：123456"/>
                    </td>
                </tr>
                 <tr>
                    <td align="right">
                        <span>微信：</span>
                    </td>
                    <td>
                        <input name="email" type="text"  value="{{$wx}}"  placeholder="如：yht">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="submit_input clearfix pl130" style="padding-left:208px;">
    <input type="submit" value="" name="Save" class="width141" />
    <span class="width141" onclick="reset()"></span>

</div>

<script src="/web/member/layui/jquery-2.2.3.min.js" type="text/javascript"></script>
<script src="/web/member/ajaxfileupload.js" type="text/javascript"></script>
<script src="/web/member/formValidator-4.0.1.min.js" type="text/javascript"></script>
<script src="/web/member/formValidatorRegex.js" type="text/javascript"></script>
<script src="/web/member/layui/layer.js" type="text/javascript"></script>
<script src="/web/member/layui/layui.all.js" type="text/javascript"></script>

<script type="text/javascript">
     $(document).ready(function () {
        
        $.formValidator.initConfig({
            formID: "form1",
            onError: function () {
                parent.ShowAlert("请完整填写！")
            }
        });
        $("#txtname").formValidator({
            onShow: "请输入标题名称(2至30字)",
            onFocus: ""
        }).inputValidator({
            min: 2,
            max: 30,
            onError: "请输入标题名称(2至30字)"
        });

    })
    function reset() {
        window.location = location.href;
    }
</script>