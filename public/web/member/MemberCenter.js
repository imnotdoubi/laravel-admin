//文本编辑框
function ShowEditor(txtid, formid) {
    KE.show({
        id: txtid,
        imageUploadJson: '/JF_YM_Manager/Editor/upload_json.ashx',
        items: [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist'],
        allowFileManager: true,
        afterCreate: function(id) {
            KE.event.ctrl(document, 13, function() {
                KE.util.setData(id);
                document.forms[formid].submit();
            });
            KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
                KE.util.setData(id);
                document.forms[formid].submit();
            });
        }
    });
}
//QQ编辑框
function ShowQQEditor(txtid, formid) {
    KE.show({
    id: txtid,
        allowFileManager: true,
        afterCreate: function(id) {
            KE.event.ctrl(document, 13, function() {
                KE.util.setData(id);
                document.forms[formid].submit();
            });
            KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
                KE.util.setData(id);
                document.forms[formid].submit();
            });
        },
        items: ['QQhtml']
    });
}
$("#txtVcode").focus(function() {
    if ($("#imgvcode").length == 0) {
        $(this).after($("<img id='imgvcode' src='/ashx/VCode.ashx?id='" + Math.random() + "/>"));
    }
    if ($(this).val() == "点击查看图片") {
        $(this).val("");
    }
}).blur(function() {
    setTimeout('$("#imgvcode").fadeOut("slow", function() {$("#imgvcode").remove();});', 2000);
    if ($(this).val() == "") {
        $(this).val("点击查看图片");
    }
});

function reset() {
    window.location = window.location.href;
}
//提示信息 自动关闭
function ShowMessage(msg) {
    $.dialog({ time: 1,
        icon: 'succeed',
        fixed: true,
        lock: true,
        content: msg
    });
}
//提示信息 关闭调用回传方法
function ShowMessageFunc(msg, yes) {
    $.dialog({
        icon: 'succeed',
        fixed: true,
        lock: true,
        content: msg,
        ok: function() { yes.call(this); }
    });
}
//警告信息
function ShowAlert(msg) {
    $.dialog({
        content: msg,
        icon: 'warning',
        fixed: true,
        lock: true,
        okVal: "确定",
        ok:true
    });
}
//确认信息
function ShowConfirm(msg,yes) {
    $.dialog({
        content: msg,
        icon: 'question',
        fixed: true,
        lock: true,
        okVal: "确定",
        ok: function() { yes.call(this); },
        cancel: true
    });
}