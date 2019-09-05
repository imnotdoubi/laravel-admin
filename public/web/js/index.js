 //排行榜切换
// 加入收藏;
    function AddFavorite(sURL, sTitle) {
        try {
            window.external.addFavorite(sURL, sTitle)
        } catch (e) {
            try {
                window.sidebar.addPanel(sTitle, sURL, "")
            } catch (e) {
                alert("加入收藏失败，请使用Ctrl+D进行添加")
            }
        }
    }

// 设置主页
    function SetHome(obj, vrl) {
        try {
            obj.style.behavior = 'url(#default#homepage)';
            obj.setHomePage(vrl)
        } catch (e) {
            if (window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect")
                } catch (e) {
                    alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。")
                }
                ;
                var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                prefs.setCharPref('browser.startup.homepage', vrl)
            }
        }

}



$(function(){
	$('.flexslider').flexslider({
		directionNav: true,
		pauseOnAction: false
	});
	$(".flexslider").hover(function(){
                    $(".flexslider .flex-direction-nav").fadeIn()
		},function(){
			$(".flexslider .flex-direction-nav").fadeOut()
		});

});





$(function(){
	$('.flexslider2').flexslider({
		animation: 'slide',
		pauseOnHover: true,

	});
	$(".flexslider2").hover(function(){
                    $(".flexslider2 .flex-direction-nav").fadeIn()
		},function(){
			$(".flexslider2 .flex-direction-nav").fadeOut()
		});
});	



$(function(){
	$('.flexslider3').flexslider({
		animation: 'slide',
		pauseOnHover: true,

	});
});	




$(function() {
		$('#carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: true,
			
			itemWidth: 88,
			itemMargin: 5,
			asNavFor: '#slider'
		});

		$('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: true,
			slideshow: true,
			slideshowSpeed: 5000, // 自动播放速度毫秒
			animationSpeed: 600, //滚动效果播放时长
			sync: "#carousel"
		});
	});	
	
	

$(function(){
	$('.anli_marquee').kxbdSuperMarquee({
		isAuto:true,
		distance:231,
		time:4,
		btnGo:{right:'.anli_pre',left:'.anli_next'},
		direction:'left'
	});

});







 


















$(function () {
	
	$('.ranking ul li:eq(0)').addClass('red');
	$('.ranking ul li:eq(1)').addClass('red');
	$('.ranking ul li:eq(2)').addClass('red');
	
	
	$('.pinpai_list ul li:eq(5)').addClass('red');
	$('.pinpai_list ul li:eq(6)').addClass('red');
	$('.pinpai_list ul li:eq(7)').addClass('red');
	$('.pinpai_list ul li:eq(8)').addClass('red');
	$('.pinpai_list ul li:eq(9)').addClass('red');
	
	$('.pinpai_list ul li:eq(15)').addClass('red');
	$('.pinpai_list ul li:eq(16)').addClass('red');
	$('.pinpai_list ul li:eq(17)').addClass('red');
	$('.pinpai_list ul li:eq(18)').addClass('red');
	$('.pinpai_list ul li:eq(19)').addClass('red');
	
	
});


$(function(){

	 $(".xm_list1 ul li").mouseover(function(){
		$(this).find('div').animate({'bottom':'0'},'fast').parents('li').siblings().find('div').animate({'bottom':'-24px'},'fast')
		
	})
	 $(".xm_list1 ul li").mouseleave(function(){
		$(this).find('div').animate({'bottom':'-24px'},'fast')
		
	})

});







$(function(){
        var liuyan = $(".liuyan_k").offset().top;

        $(".go_ly").click(function(){
            $("html,body").animate({scrollTop: liuyan}, 500);
        });
    });



$(function(){
        var xiangqing = $("#jmxq").offset().top-80;
		var tiaojian = $("#jmtj").offset().top-80;
		var liucheng = $("#jmlc").offset().top-80;

        $(".item-article-tab ul li:eq(0)").click(function(){
            $("html,body").animate({scrollTop: xiangqing}, 500);
			$(this).addClass("current");
			$(".item-article-tab ul li:eq(1)").removeClass("current");
			$(".item-article-tab ul li:eq(2)").removeClass("current");
        }).addClass("current");
		
		$(".item-article-tab ul li:eq(1)").click(function(){
            $("html,body").animate({scrollTop: tiaojian}, 500);
			$(this).addClass("current");
			$(".item-article-tab ul li:eq(0)").removeClass("current");
			$(".item-article-tab ul li:eq(2)").removeClass("current");
        });
		
		$(".item-article-tab ul li:eq(2)").click(function(){
            $("html,body").animate({scrollTop: liucheng}, 500);
			$(this).addClass("current");
			$(".item-article-tab ul li:eq(0)").removeClass("current");
			$(".item-article-tab ul li:eq(1)").removeClass("current");
        });
    });




$(document).scroll(function(){
	//获取窗口的滚动条的垂直位置
	var s = $(document).scrollTop();
	//当窗口的滚动条的垂直位置大于页面的最小高度时，让返回顶部元素渐现，否则渐隐
	if( s > 570){
		$("#con-nav").addClass("fixed_nav");
	}else{
		$("#con-nav").removeClass("fixed_nav");
		}

	if( s > 2300){
		$(".barnd_r").addClass("fixed_brand");
	}else{
		$(".barnd_r").removeClass("fixed_brand");
		}

	
 });
 
 	