$(document).ready(function () {
    //判断当前页面，会员是否登录

    var img = $("#userNewMessage p img");
    $("#user-product").click(function () {
        window.location.href = "/member/";
    });
    $("#user-shop").click(function () {
        window.location.href = "/member/";
    });
    $("#user-center").click(function () {
        window.location.href = "/member/";
    });
    $(".no_login").css("display", "none");
    $(".no_loginOut").css("display", "block");
    $(".no_loginOut").css({
        color: "#fff",
        background: "#bd0000"
    });

    $(".index-serch-clssify a").click(function () {
        $(".index-serch-clssify a").css("color", "#666");
        $(this).css("color", "#BD0000");
        var pla = "请输入您要查询的" + $(this).text() + "名称";
        $("#index-s-ipt").attr("placeholder", pla);
    });
    var bT = $("#bT");
    bT.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
    });
    $("#imgvocode").hover(function () {
        $("#Img1").css("display", "block");
    });
    $("#imgvocode").mouseout(function () {
        $("#Img1").css("display", "none");
    });
    $("#index-s-btn").click(function () {
        var input = $("#index-s-ipt");
        var key = input.val().trim();
        if (key == "") {
            alert("请输入您要查询的内容！");
            return false;
        } else {
            //获取被选中的查询类型
            var txt = "";
            $(".index-serch-clssify a").each(function () {
                if ($(this).css("color") == "rgb(189, 0, 0)") {
                    txt = $(this).text();
                }
            });
            var pla = "请输入您要查询的" + $(this).text() + "名称";
            if (pla == key) {
                alert(pla);
                return false;
            } else {
                key = encodeURI(key);
                var url = "";
                if (txt == "产品") {
                    url = "/soso/chanpin_" + key + ".html";
                } else if (txt == "公司") {
                    url = "/soso/gongsi_" + key + ".html";
                } else if (txt == "展会") {
                    url = "/soso/zhanhui_" + key + ".html";
                } else if (txt == "品牌") {
                    url = "/soso/pinpai_" + key + ".html";
                }
                if (url != "") {
                    window.location.href = url;
                }
            }
        }
    });
    //退出登录
});