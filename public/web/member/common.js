
function Go(url) {
    document.getElementById("mainFrame").src = url;
}
// 左侧导航的展开&&合并
$(function () {
    var Height = [];
    $(".content_left ul>li").each(function (i) {
        Height[i] = 0;
    });
    $(".content_left ul li div h3").click(function () {
        var h =$(this).parents("li").index();
        var ul = $(this).parent("div").siblings("ul");
        var ulHeight = ul.outerHeight();
        ul.stop(true, true, true);
        if (Height[h] == 0) {
            ulHeight = ul.outerHeight();
            Height[h] = ulHeight;
        }else if (Height[h] > 0){
            ulHeight = Height[h];
            Height[h] = 0;
        }
        
        if (Height[h] > 0) {
            $(this).addClass("spread");
            ul.animate({"height": "0"}, 200);
        } else{
            $(this).removeClass("spread");
            ul.animate({"height": ulHeight + "px"}, 200);
        }
        return false;
    });
});

// 导航左侧 商机信息管理 hover状态
$(function () {
    $(".content_left li.pos_rel").hover(function () {
        $(this).parent("ul").css({"overflow": "visible"});
        $(this).addClass("business_hover").find("ul").show();
    }, function () {
        $(this).removeClass("business_hover").find("ul").hide();
        $(this).parent("ul").css({"overflow": "hidden"});
    });
});

/********************************************/
/*             自定义下拉列表               */
// a: 下拉按钮  选择器
// b: 下拉选项  选择器
// c: 下拉选项容器  选择器
// d: 呈现选择内容的容器  选择器
/********************************************/

// 头部自定义下拉列表
$(function() {
    searchChange(".showSelected", ".showSelected ul li", ".showSelected ul", "#text_show");


    function searchChange(a, b, c, d) {
        // 形参保存到数组中
        var Arr = [a, b, c, d];
        // 遍历所有参数，查看参数类型
        $.each(Arr, function(i) {
            var type = typeof (Arr[i]);
            Arr[i] = type == "string" ? $(Arr[i]) : Arr[i];
        });

        var n = 0;  // 记录当前下拉列表的状态，1为下拉状态，0为隐藏状态
        // 动态设置下拉列表容器的高度
        var ulHeight = (Arr[1].length - 1) * Arr[1].outerHeight();
        // 下拉按钮被点击
        Arr[0].toggle(function() {
            n++;
            Arr[2].show();
            Arr[2].show().animate({ "height": ulHeight + "px" }, 200);
        }, function() {
            n = 0;
            Arr[2].animate({ "height": "0px" }, 200, function() { Arr[2].hide(); });
        });
        // 下拉列表项被点击
        Arr[1].click(function() {
            Arr[1].removeClass("Selected").show();
            $(this).addClass("Selected").hide();
            var value = $(this).text();
            showSelectedText(value);
            setValue(value);
            Arr[0].trigger("click");
        });
        // 设置选中列表内容
        function showSelectedText(val) {
            Arr[3].text(val);
        }
        // 点击页面其他位置，下拉列表隐藏
        $(document).click(function(e) {
            e = e || window.event;
            if (n != 0) {
                Arr[0].trigger("click");
            }
        });
        // 初始显示第一个列表项
        Arr[1].eq(0).hide();
    }

});
/****************头部搜索******************/

function setSouSuoTextValue(e) {
    var str = $(e).val();
    if (str.indexOf("请输入") > -1) {
        $(e).val("");
        $(e).css("color", "#000");
    }
    
}
function SouSuoTextValueOnBlur(e) {
    if ($(e).val() == "" || $(e).val().length < 1) {
        SetSousuoTextVal();
        $(e).css("color", "#ccc");
    }
}
function SearchTypeClick(e) {
    $("li[class='Selected']").removeClass("Selected");
    $(e).parent().addClass("Selected");
    $("input:hidden[id$='SearchHidden']").val($(e).text());
    SetSousuoTextVal();
}
function SetSousuoTextVal() {
    var val = $("input:hidden[id$='SearchHidden']").val();
    if (val == "公司" || val == "产品" || val == "展会" || val == "品牌") {
        $("input:text[id$='SouSuoText']").val("请输入" + val + "的名称");
    }
    else if (val == "新闻" || val == "百科") {
        $("input:text[id$='SouSuoText']").val("请输入" + val + "的标题");
    }
    else if (val == "图片") {
        $("input:text[id$='SouSuoText']").val("请输入产品的名称");
    }
    else {
        $("input:text[id$='SouSuoText']").val("请输入关键字");
    }
}

// sou suo ti shi 
function getResult()
{
    var url = "http://" + window.location.host + "/ashx/SouSuoResult.ashx";
    $("#" + $("input[tipsfindid='tips_SouSuoText']").attr("id")).txttips({
        url: url, // JOSN 获取URL地址
        param: "c_txt", // 获取JOSN数据时提交的参数名          
        leftText: "text", // 提示列表左边显示文字的JSON字段
        rightText: "text2", // 提示列表右边显示文字的JSON字段
        inputText: "text", // 点击提示列表后显示在输入框内容的JSON字段
        text_yes_no: "yes",
        width: 330// 提示列表宽度，可选
    });
}


function setValue(aValue) {
    var aValue = aValue.replace(/\s/g, "");
    var textVal = $("#SouSuoText").val();
    var aValue = aValue.toString();
    $("#SouSuoText").css({ "color": "rgb(180, 180, 180)" });
    if (textVal == "" || textVal == "请输入产品名称" || textVal == "请输入公司名称" || textVal == "请输入品牌名称" || textVal == "请输入图片名称" || textVal == "请输入展会名称") {
        $("#SouSuoText").val("请输入" + aValue + "名称");
    }
    if (aValue == "产品") {
        $("#search_act").attr("value", 'chanpin');
    }
    else if (aValue == "公司") {
        $("#search_act").attr("value", 'gongsi');
    }
    else if (aValue == "品牌") {
        $("#search_act").attr("value", 'pinpai');
    }
    else if (aValue == "图片") {
        $("#search_act").attr("value", 'xinwen');
    }
    else if (aValue == "展会") {
        $("#search_act").attr("value", 'zhanhui');
    }
}


/* Search button */
function SoSearch() {
    var valueName = $("#search_act").val().replace(/^\s+|\s+$/g, "");
    var keyWord = $("#SouSuoText").val().replace(/^\s+|\s+$/g, "");
    if (keyWord == "" || keyWord == "请输入产品名称" || keyWord == "请输入公司名称" || keyWord == "请输入品牌名称" || keyWord == "请输入图片名称" || keyWord == "请输入展会名称") {
        alert("请输入搜索关键词！");
    }
    else {
        var key = encodeURI(keyWord);
        var url = "";
        if (valueName == "chanpin") {
            url = "http://www.7999.tv/soso/chanpin_" + key + ".html";
        }
        else if (valueName == "gongsi") {
            url = "http://www.7999.tv/soso/gongsi_" + key + ".html";
        }
        else if (valueName == "pinpai") {
            url = "http://www.7999.tv/soso/pinpai_" + key + ".html";
        }
        else if (valueName == "xinwen") {
            url = "http://www.7999.tv/soso/tupian_" + key + ".html";
        }
        else if (valueName == "zhanhui") {
            url = "http://www.7999.tv/soso/zhanhui_" + key + ".html";
        }
        if (location.href.indexOf("http://www.7999.tv/soso/") > -1) {
            location.href=url;
        }
        else {
            window.open(url);
        }
    }
}
// 搜索框失去焦点后，判断是否存在输入内容，如果内容为空，则重置提示
$(function () {
    $("#SouSuoText").blur(function () {
        if ($(this).text() == "") {
            var aValue = $(".Selected").text();
            setValue(aValue);
        }
    });

});

// Event13
function EnterPress(e) { //传入 event
    var e = e || window.event;
    if (e.keyCode == 13) {
        SoSearch();
    }
}

/****************搜索结束**********************/

