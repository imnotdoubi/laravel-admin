$(function(){
	var n=0;
	$('#banner img').hide().eq(0).show();
	function now(){
		n++;
		if(n>$('#banner img').length-1){n=0};
		$('#banner img').fadeOut('fast').eq(n).fadeIn('fast');
		$('#banner font').removeClass().eq(n).addClass('se');
	}
	var timer=setInterval(now,2000);
	$('#banner').hover(function(){
		clearInterval(timer);	
		},function(){
		timer=setInterval(now,2000);
	});
	$('#banner font').mouseover(function(){
		$('#banner font').removeClass();
		$(this).addClass('se');
		var m=$(this).index();
		$('#banner img').fadeOut('fast').eq(m).fadeIn('fast');
	});
	/*$('.ad-seats-right li').mouseover(function(){
		$('.ad-seats-right li').removeClass("none").eq(this).addClass("none");
		$(this).find("a").addClass("xile");
		var n = $(this).index(); 
		console.log(n);
		$(".ad-seats-right .ding").hide().eq($(this).index()).show();//.css("display","none").eq(n).css("display","block");
		});*/
	
	$('.ad-seats-right > li').hover(function(){
		//$('.ad-seats-right > li').removeClass("none").eq($(this).index()).addClass("none");
		$($(this).parent().find("li")).removeClass("none").eq($(this).index()).addClass("none");
		var n = $(this).index(); 
		//console.log( $('.ad-seats-right > li').length  + "=====" + n);
		//$(".ad-seats-right .ding").hide().eq(n).show();
		$($(this).parent().find("ul")).hide().eq(n).show();
	},function(){
		
		});
	
});
/*function $(id) {
      return typeof id==='string'?document.getElementById(id):id;
    }
    window.onload=function(){
      var index=0;
      var timer=null;
      var pic=$("pic").getElementsByTagName("li");
      var num=$("num").getElementsByTagName("li");
      var flash=$("flash");
      var left=$("left");
      var right=$("right");
      //单击左箭头
      left.onclick=function(){
        index--;
        if (index<0) {index=num.length-1};
        changeOption(index);
      }
      //单击右箭头
      right.onclick=function(){
        index++;
        if (index>=num.length) {index=0};
        changeOption(index);
      }      
      //鼠标划在窗口上面，停止计时器
      flash.onmouseover=function(){
        clearInterval(timer);
      }
      //鼠标离开窗口，开启计时器
      flash.onmouseout=function(){
        timer=setInterval(run,5000)
      }
      //鼠标划在页签上面，停止计时器，手动切换
      for(var i=0;i<num.length;i++){
        num[i].id=i;
        num[i].onmouseover=function(){
          clearInterval(timer);
          changeOption(this.id);
        }
      }    
      //定义计时器
      timer=setInterval(run,5000)
      //封装函数run
      function run(){
        index++;
        if (index>=num.length) {index=0};
        changeOption(index);
      }
      //封装函数changeOption
      function changeOption(curindex){
//      console.log(index)
        for(var j=0;j<num.length;j++){
          pic[j].style.display="none";
          num[j].className="";
        }
        pic[curindex].style.display="block";
        num[curindex].className="active";
        index=curindex;
      }
    }
    
    //广告位两张图片切换
function AutoScroll(obj) {
				jQuery(obj).find("ul").animate({
					marginTop: "-54px"
				}, 5000, function () {
					jQuery(this).css({ marginTop: "0px" }).find("ul").appendTo(this);
				});
			}
			jQuery(document).ready(function(){
				//6f
				setInterval('AutoScroll("#scrollDiv")', 5000);
				//鼠标悬停，图片移除
				jQuery(".imgMove").parent().hover(function () {
						var img = jQuery(this).find("img");
						img.stop().animate({ left: '100%' });
					}, function () {
						var img = jQuery(this).find("img");
						img.stop().animate({ left: '0%' });
				});
			});*/