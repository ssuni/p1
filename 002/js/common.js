$(function () {
	// 상단배너 
	var slider1 = $('#top_banner .slider_wrap ul').bxSlider({		
		auto : true,
		pager : false,
	});

	$(document).on('click','#top_banner .bx-pager',function() {
		slider1.stopAuto();
		slider1.startAuto();
	});	


	$("#right_quick").rightQuickInit();

});

(function( $ ) {

	$.fn.imgOnOffInit = function() {
		
		var $this = this;
		var pre = -1;
		var interval;
		var max = 6;
		var menuHeight = 80;

		function config(){
			$this.find("li").mouseover(imgOver).mouseout(imgOut);
		}		
		function imgOver(){			
			var src = $(this).find('img').attr('src');				
			var src2="";
			src = src.replace("_on","");
			src2 = src.replace(".png","_on.png");
			$(this).find(' img').attr('src',src2);
		}
		function imgOut(){				
			var src = $(this).find('img').attr('src');				
			var src2="";
			src2 = src.replace("_on.png",".png")
		    $(this).find('img').attr('src',src2);
		}
		

		config();

    };





	// 오른쪽배너
	$.fn.rightQuickInit = function() {
		
		var $this = this;	
		var interval;
	
		function config(){

			$this.mouseover(areaOver).mouseout(areaOut);
		
			var scrollTop = $(document).scrollTop();
			// On loading, check to see if more than 15px, then add the class
			if (scrollTop > 175) {
				
				$this.addClass('fixed');
			}

			// On scrolling, check to see if more than 15px, then add the class
			$(window).on('scroll', function() {			
				scrollTop = $(document).scrollTop();
				if (scrollTop > 175) {
					$this.addClass('fixed');
				} else {
					$this.removeClass('fixed');
				}
			});
		}
		function areaOver(){
			$(".dark_bg").css("display","block");
			$(".dark_bg").stop().stop().animate({opacity:.7},{ duration: 400});
		}
		function areaOut(){			
			$(".dark_bg").stop().stop().delay(100).animate({opacity:0},{duration:400,complete:endMotion});
		}
		function endMotion(){
			$(".dark_bg").css("display","none");
		}
		

		config();

    };






})( jQuery );





function popOpen(){
	$("#main_pop").css("display","block");
}
function popClose(){
	$("#main_pop").css("display","none");
}

function onlineLink(){
	location.href="/new/community/community03.php";
}
function reviewLink(){
	location.href="/new/community/community05.php";
}
function kakaoLink(){
	location.href="/new/community/community04.php";
}