/*
* 调用方式：$(input).tips(options);
* options: 参数选项
*		url  JOSN 获取URL地址
*		param  获取JOSN数据时提交的参数名			
*		leftText  提示列表左边显示文字的JSON字段
*		rightText  提示列表右边显示文字的JSON字段
*		inputText  点击提示列表后显示在输入框内容的JSON字段
*
*		hiddenId  隐藏域id 可选
*		hiddenText  隐藏域值 可选
*		width  提示列表宽度，可选(超宽时自动加宽, 默认为300)
*		selectClass 选中样式
*
* 要求返回的JSON数据格式为：
*		[{key:value,key:value...},{key:value,key:value...},...]
*/
var t;
(function($) {
    $.txttips = function(input, options) {
        var $input = $(input);
        var $tipsList = $("#tips-list-div-" + $input.attr("id"));
        //var $hiddenTips = $("#tips-list-hidden-div-" + $input.attr("id"));

        $input.attr({ "autocomplete": "off" }); // 禁止浏览器自动完成功能
        $input.focus(function(e) {
            getData(e);
        });

        $input.blur(function() {
            setTimeout("jQuery('#tips-list-div-" + $input.attr("id") + "').slideUp('slow')", 100);
        });

        //         

        //         
        if (options.text_yes_no == "yes") {
            $input.keydown(processKey);
            $input.keyup(getData);
        } else {
            $input.keydown(processKey);
            getData($input);
        }
        function processKey(e) {
            if (testSpeKey(e) && ($tipsList.is(':visible') || getCurrentSelect())) {
                if (e.preventDefault)
                    e.preventDefault();

                if (e.stopPropagation)
                    e.stopPropagation();
                e.cancelBubble = true;
                e.returnValue = false;

                switch (e.keyCode) {
                    case 38: // up
                        prevSelect();
                        break;
                    case 40: // down 
                        nextSelect();
                        break;
                    case 13: // 回车
                        selectCurrent();
                        break;
                }
            }
        }

        // 当前选中的li
        function getCurrentSelect() {
            if (!$tipsList.is(':visible'))
                return false;

            var $currentSelect = $tipsList.children('ul').children('li.' + options.selectClass);
            if (!$currentSelect.length)
                $currentSelect = false;

            return $currentSelect;
        }

        // 将当前选中li返回到 input 中
        function selectCurrent() {
            $currentSelect = getCurrentSelect();
            if ($currentSelect) {
                $input.val($currentSelect.attr("inputText"));
                if (options.bian1 != null) {
                    $("#" + options.bian1).attr(options.bian1_value, $currentSelect.attr(options.bian1));
                }
                if (options.bian2 != null) {
                    $("#" + options.bian2).attr(options.bian2_value, $currentSelect.attr(options.bian2));
                }
                if (options.bian3 != null) {
                    $("#" + options.bian3).attr(options.bian3_value, $currentSelect.attr(options.bian3));
                }
                if (options.bian4 != null) {
                    $("#" + options.bian4).attr(options.bian4_value, $currentSelect.attr(options.bian4));
                }
                if (options.events != null) {
                    window[options.events]();
                }
                if ($(this).attr("hidenId") != null && $(this).attr("hidenId") != "") {
                    $("#" + $(this).attr("hidenId")).val($(this).attr("hiddenText"));
                }
                hiddenTips();
                $input.blur()
            }
        }

        // 向下选择
        function nextSelect() {
            $currentSelect = getCurrentSelect();
            if ($currentSelect)
                $currentSelect.removeClass(options.selectClass).next().addClass(options.selectClass);
            else
                $tipsList.children('ul').children('li:first-child').addClass(options.selectClass);
        }

        // 向上选择
        function prevSelect() {
            $currentResult = getCurrentSelect();

            if ($currentResult)
                $currentResult.removeClass(options.selectClass).prev().addClass(options.selectClass);
            else {
                $tipsList.children('ul').children('li:last-child').addClass(options.selectClass);
            }

        }

        // 测试是否 特殊键
        function testSpeKey(e) {
            // handling up/down/escape requires results to be visible
            // handling enter/tab requires that AND a result to be selected
            if (/27$|38$|40$/.test(e.keyCode) || /^13$|^9$/.test(e.keyCode)) {
                return true;
            }
        }

        // 通过AJAX获取json数据
        function getData(e) {
            if (!t) {
                t = setTimeout(_get_Data(e), 300);
            } else {
                clearTimeout(t);
                t = setTimeout(_get_Data(e), 300);
            }
        }
        function _get_Data(e) {
            return function() {
                get_Data(e);
            }
        }
        function get_Data(e) {
            if (testSpeKey(e)) {
                return;
            }
            if (options.text_yes_no == "yes") {
                if ($input.val() != "") {
                    var param = "";
                    if (options.data != null) {
                        param = window[options.data]();
                    } else {
                        param = options.param + "=" + escape($input.val());
                    }
                    $.ajax({
                        type: "POST",
                        url: options.url + "?" + param,
                        success: function(data) {
                            displayDiv(eval(data));
                        }
                    });
                } else {
                    hiddenTips();
                }
            } else {
                var param = "";
                if (options.data != null) {
                    param = window[options.data]();
                } else {
                    param = options.param + "=" + $input.val();
                }
                $.ajax({
                    type: "POST",
                    url: options.url + "?" + param,
                    success: function(data) {
                        displayDiv(eval(data));
                    }
                });
            }
        }

        // 初始化提示列表 每次AJAX获取数据后调用
        function initTips() {
            $tipsList.find("ul").find("li").each(function() {
                $(this).mouseover(function() {
                    $(this).addClass(options.selectClass);
                });
                $(this).mouseout(function() {
                    $(this).removeClass(options.selectClass);
                });
                $(this).click(selectCurrent)
            });
        }

        // 清除样式
        function cleanClass() {
            $tipsList.find("ul").find("li").each(function() {
                $(this).removeClass(options.selectClass);
            });
        }

        // 显示提示列表
        function showTips(html) {
            $tipsList.html(html);
            //$hiddenTips.html(html);
            var offset = $input.offset();
            var height = $input.outerHeight();
            $tipsList.css("top", offset.top + height);
            $tipsList.css("left", offset.left);
            var width = options.width;
            initTips();
            //$hiddenTips.css("display", "block");
            //            $hiddenTips.find("li").each(function() {
            //                var span = $(this).find("span");
            //                var width1 = $(span[0]).width() + $(span[1]).width() + 20;
            //                var width2 = $(this).width() + 20;
            //                var maxWidth = width1 > width2 ? width1 : width2;
            //                width = width > maxWidth ? width : maxWidth;
            //                width = width > max_width ? max_width : width;
            //            });
            //$hiddenTips.css("display", "none");
            $tipsList.width(width);
            $tipsList.show();
        }

        // 隐藏提示列表
        function hiddenTips() {
            $tipsList.slideUp("slow");
        }

        // 将JOSN数据生成DIV
        function displayDiv(json) {

            //            if (json.length <= 0) {
            //                div += "<li hidenId='' hiddenText='' inputText=''><span class='tipsleft'>无数据！</span><span class='tipsright'></span></li>";
            //            }
            if (json.length > 0) {
                var div = "<ul>";
                for (var i = 0; i < json.length; i++) {
                    div += "<li ";
                    if (options.hiddenId != null) {
                        div += " hidenId='" + options.hiddenId + "' hiddenText='" + eval("json[i]." + options.hiddenText) + "' ";
                    }
                    div += "inputText='" + eval("json[i]." + options.inputText) + "'"
                    if (options.bian1 != null) {
                        div += options.bian1 + "='" + eval("json[i]." + options.bian1) + "'"
                    }
                    if (options.bian2 != null) {
                        div += options.bian2 + "='" + eval("json[i]." + options.bian2) + "'"
                    }
                    if (options.bian3 != null) {
                        div += options.bian3 + "='" + eval("json[i]." + options.bian3) + "'"
                    }
                    if (options.bian4 != null) {
                        div += options.bian4 + "='" + eval("json[i]." + options.bian4) + "'"
                    }

                    div += ">";
                    div += "<span class='tipsleft' title='" + eval("json[i]." + options.leftText) + "' >" + eval("json[i]." + options.leftText).substring(0, 15) + "</span>";
                    div += "<span class='tipsright'>" + eval("json[i]." + options.rightText) + "</span>";
                    div += "</span></li>";
                }
                div += "</ul>";
                showTips(div);
            }
        }
    }

    $.fn.txttips = function(options) {
        options = options || {};
        options.url = options.url || ""; // 获取JSON数据的url地址
        options.param = options.param || this.id; // 获取JOSN数据时提交的参数名
        options.width = options.width || 300;
        options.leftText = options.leftText || "leftText"; // 提示列表左边显示文字的JSON字段
        options.rightText = options.rightText || "rightText"; // 提示列表右边显示文字的JSON字段
        options.inputText = options.inputText || "inputText"; // 点击提示列表后显示在输入框内容的JSON字段

        options.text_yes_no = options.text_yes_no || "yes"; //是否为文本框
        options.data = options.data || null; // 获取JOSN数据时提交的参数名

        options.bian1 = options.bian1 || null;
        options.bian1_value = options.bian1_value || "value";
        options.bian2 = options.bian2 || null;
        options.bian2_value = options.bian2_value || "value";
        options.bian3 = options.bian3 || null;
        options.bian3_value = options.bian3_value || "value";
        options.bian4 = options.bian4 || null;
        options.bian4_value = options.bian4_value || "value";

        options.events = options.events || null; //代码运行完后，进行的事件 最好不要带参数

        options.hiddenId = options.hiddenId || null; // 如有需要在隐藏域添加隐藏表单信息时，请填写隐藏域的 id
        options.hiddenText = options.hiddenText || "hiddenText"; // 如有需要在隐藏域添加隐藏表单信息时，隐藏域内容对应的JOSN字段
        options.selectClass = options.selectClass || "tips-div-hover"; // 选中样式

        if ($("#tips-list-div-" + this.attr("id")).attr("class") == undefined) {
            $(document.body).append("<div id='tips-list-div-" + this.attr("id") + "' class='tips-div' style='max-height:300px;overflow:auto;'>1</div>");
        }
        //        if ($("#tips-list-hidden-div-" + this.attr("id")).attr("class") == undefined) {
        //            $(document.body).append("<div id='tips-list-hidden-div-" + this.attr("id") + "' style='visibility:hidden;display:none;height:300px;overflow:auto;'>1</div>");
        //        }

        this.each(function() {
            new $.txttips(this, options);
        });

        return this;
    }
})(jQuery);

// 动态增加JS
function loadjscssfile(filename, filetype) {

    //如果文件类型为 .js ,则创建 script 标签，并设置相应属性 

    if (filetype == "js") {

        var fileref = document.createElement('script');

        fileref.setAttribute("type", "text/javascript");

        fileref.setAttribute("src", filename);

    } //如果文件类型为 .css ,则创建 script 标签，并设置相应属性 

    else if (filetype == "css") {

        var fileref = document.createElement("link");

        fileref.setAttribute("rel", "stylesheet");

        fileref.setAttribute("type", "text/css");

        fileref.setAttribute("href", filename);

    }

    if (typeof fileref != "undefined")

        document.getElementsByTagName("head")[0].appendChild(fileref);

}

var filesadded = "";

function checkloadjscssfile(filename, filetype) {

    if (filesadded.indexOf("[" + filename + "]") == -1) {

        loadjscssfile(filename, filetype);

        filesadded += "[" + filename + "]";

    }
    else {
        //alert("此文件已经被载入过!");
    }

}
checkloadjscssfile("/JS/tips/tips.css", "css")
//第一次载入 

//    checkloadjscssfile("myscript.js", "js");

//    //重复载入同一个文件， 失败 

//    checkloadjscssfile("myscript.js", "js");